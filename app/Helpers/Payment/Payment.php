<?php

namespace App\Helpers\Payment;

use App\Helpers\Payment\Lib\Core;

class Payment extends Core
{


    /**
     * To specify either the payment will be onsite or offsite
     * (default value: false)
     *
     * @var boolean
     */
    protected $isDirectPayment = false;

    private $customer               = [];
    private $address                = [];
    private $items                  = [];
    private $total                  = 0;
    private $lang                   = "en";
    private $DisplayCurrencyIso     = "sar";
    private $CallBackUrl            = 'payment/success';
    private $ErrorUrl               = 'payment/error';
    private $CustomerReference      = "noshipping-nosupplier";
    private $SourceInfo             = "string";

    // new Fuc

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    public function setCustomer($customer = []) {
        $data = [
            "CustomerName"      =>  (array_key_exists('name',$customer)) ? $customer['name'] : 'dev.tasawk',
            "MobileCountryCode" =>  (array_key_exists('code',$customer)) ? $customer['code'] : '966',
            "CustomerMobile"    =>  (array_key_exists('mobile',$customer)) ? $customer['mobile'] : '523145687',
            "CustomerEmail"     =>  (array_key_exists('email',$customer)) ? $customer['email'] : 'info@tasawk.net',
        ];
        $this->customer = $data;
        return $this;
    }

    public function setAddress($address = []) {
        $data = [
            "Block"                 => (array_key_exists('block',$address)) ? $address['block'] : 'tasawk',
            "Street"                => (array_key_exists('street',$address)) ? $address['street'] : 'tasawk',
            "HouseBuildingNo"       => (array_key_exists('building',$address)) ? $address['building'] : 'tasawk',
            "Address"               => (array_key_exists('address',$address)) ? $address['address'] : 'tasawk',
            "AddressInstructions"   => (array_key_exists('instructions',$address)) ? $address['instructions'] : 'tasawk',
        ];
        $this->address = $data;
        return $this;
    }

    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    public function setLang($lang) {
        $this->lang = $lang;
        return $this;
    }

    public function setCurrencyIso($DisplayCurrencyIso) {
        $this->DisplayCurrencyIso = $DisplayCurrencyIso;
        return $this;
    }

    public function setCallBackUrl($CallBackUrl) {
        $this->CallBackUrl = $CallBackUrl;
        return $this;
    }

    public function setErrorUrl($ErrorUrl) {
        $this->ErrorUrl = $ErrorUrl;
        return $this;
    }

    public function setCustomerReference($CustomerReference) {
        $this->CustomerReference = $CustomerReference;
        return $this;
    }

    public function setSourceInfo($SourceInfo) {
        $this->SourceInfo = $SourceInfo;
        return $this;
    }


    /**
     * List available Payment Gateways.
     *
     * @param real $invoiceValue
     * @param string $displayCurrencyIso
     * @return array
     */
    public function getVendorGateways($invoiceValue = 0, $displayCurrencyIso = '') {

        $postFields = [
            'InvoiceAmount' => $invoiceValue,
            'CurrencyIso'   => $displayCurrencyIso,
        ];

        $json = $this->callAPI("$this->apiURL/v2/InitiatePayment", $postFields, null, 'Initiate Payment');

        return $json->Data->PaymentMethods;
    }


    /**
     * List available Payment Gateways by type (direct, normal)
     *
     * @param bool $isDirect
     * @return array
     */
    public function getVendorGatewaysByType($isDirect = false) {

        try {
            $gateways = $this->getVendorGateways();
        } catch (\Exception $ex) {
            return [];
        }

        foreach ($gateways as $g) {
            if ($g->IsDirectPayment) {
                $directMethods[] = $g;
            } else {
                $normalMethods[] = $g;
            }
        }

        return ($isDirect && isset($directMethods)) ? $directMethods : ((!$isDirect && isset($normalMethods)) ? $normalMethods : []);
    }


    /**
     * Get Payment Method Object
     *
     * @param string $gateway
     * @param string $gatewayType ['PaymentMethodId', 'PaymentMethodCode']
     * @param real $invoiceValue
     * @param string $displayCurrencyIso
     * @return object
     * @throws \Exception
     */
    public function getPaymentMethod($gateway, $gatewayType = 'PaymentMethodId', $invoiceValue = 0, $displayCurrencyIso = '') {

        $paymentMethods = $this->getVendorGateways($invoiceValue, $displayCurrencyIso);

        foreach ($paymentMethods as $method) {
            if ($method->$gatewayType == $gateway) {
                $pm = $method;
                break;
            }
        }

        if (!isset($pm)) {
            throw new \Exception('Please contact Account Manager to enable the used payment method in your account');
        }

        if ($this->isDirectPayment && !$pm->IsDirectPayment) {
            throw new \Exception($pm->PaymentMethodEn . ' Direct Payment Method is not activated. Kindly, contact your MyFatoorah account manager or sales representative to activate it.');
        }

        return $pm;
    }

    private function formateFildes() {
        return [
            "CustomerName"=> $this->customer["CustomerName"],
            "NotificationOption"=> "ALL",
            "MobileCountryCode"=> $this->customer["MobileCountryCode"],
            "CustomerMobile"=> $this->customer["CustomerMobile"],
            "CustomerEmail"=> $this->customer["CustomerEmail"],
            "InvoiceValue"=> $this->total,
            "DisplayCurrencyIso"=> $this->DisplayCurrencyIso,
            "CallBackUrl"=> $this->CallBackUrl,
            "ErrorUrl"=> $this->ErrorUrl,
            "Language"=> $this->lang,
            "CustomerReference"=> $this->CustomerReference,
            "CustomerAddress"=> $this->address,
            "InvoiceItems"=> $this->items,
            "SourceInfo"=> $this->SourceInfo
        ];
    }


    /**
     * Get the invoice/payment URL and the invoice id
     *
     * @param integer|string $orderId
     * @param array $curlData
     * @param string $gateway (default value: 'myfatoorah')
     * @return array
     */
    public function getInvoiceURL($orderId,$gateway = 'myfatoorah') {

        $this->isDirectPayment = false;
        if ($gateway == 'myfatoorah') {
            return $this->sendPayment($orderId, $this->formateFildes());
        } else {
            return $this->excutePayment($orderId, $this->formateFildes(), $gateway);
        }
    }


    /**
     *
     * @param integer|string $orderId
     * @param array $curlData
     * @param integer|string $gatewayId
     * @return array
     */
    private function excutePayment($orderId, $curlData, $gatewayId) {

        $curlData['PaymentMethodId'] = $gatewayId;

        $json = $this->callAPI("$this->apiURL/v2/ExecutePayment", $curlData, $orderId, 'Excute Payment'); //__FUNCTION__

        return ['invoiceURL' => $json->Data->PaymentURL, 'invoiceId' => $json->Data->InvoiceId];
    }


    /**
     *
     * @param integer|string $orderId
     * @param array $curlData
     * @return array
     */
    private function sendPayment($orderId, $curlData) {

        $curlData['NotificationOption'] = 'Lnk';

        $json = $this->callAPI("$this->apiURL/v2/SendPayment", $curlData, $orderId, 'Send Payment');

        return ['invoiceURL' => $json->Data->InvoiceURL, 'invoiceId' => $json->Data->InvoiceId];
    }


    /**
     * Get the direct payment URL and the invoice id
     *
     * @param integer|string $orderId
     * @param array $curlData
     * @param integer|string $gateway
     * @param array $cardInfo
     * @return array
     */
    public function directPayment($orderId, $curlData, $gateway, $cardInfo) {

        $this->log('----------------------------------------------------------------------------------------------------------------------------------');

        $this->isDirectPayment = true;

        $data = $this->excutePayment($orderId, $curlData, $gateway);

        $json = $this->callAPI($data['invoiceURL'], $cardInfo, $orderId, 'Direct Payment'); //__FUNCTION__
        return ['invoiceURL' => $json->Data->PaymentURL, 'invoiceId' => $data['invoiceId']];
    }

    /**
     * Get the Payment Transaction Status
     *
     * @param integer|string $keyId
     * @param string $KeyType
     * @param integer|string $orderId
     * @return object
     * @throws \Exception
     */
    public function getPaymentStatus($keyId, $KeyType, $orderId = null) {

        $curlData = ['Key' => $keyId, 'KeyType' => $KeyType];

        $json = $this->callAPI("$this->apiURL/v2/GetPaymentStatus", $curlData, $orderId, 'Get Payment Status');


        if ($orderId && $json->Data->CustomerReference != $orderId) {
            throw new \Exception('Trying to call data of another order');
        } else if ($json->Data->InvoiceStatus == 'DuplicatePayment') {
            throw new \Exception('Duplicate Payment', 3); //success with Duplicate
        }

        if ($KeyType == 'PaymentId') {
            foreach ($json->Data->InvoiceTransactions as $transaction) {
                if ($transaction->PaymentId == $keyId && $transaction->Error && $json->Data->InvoiceStatus != 'Paid') {
                    throw new \Exception('Failed with Error (' . $transaction->Error . ')', 1); //faild order
                }
            }
        }

        if ($json->Data->InvoiceStatus != 'Paid') {

            //------------------
            //case 1:
            $lastInvoiceTransactions = end($json->Data->InvoiceTransactions);
            if ($lastInvoiceTransactions && $lastInvoiceTransactions->Error) {
                throw new \Exception('Failed with Error (' . $lastInvoiceTransactions->Error . ')', 1); //faild order
            }

            //------------------
            //case 2:
            //all myfatoorah gateway is set to Asia/Kuwait
            $ExpiryDate  = new \DateTime($json->Data->ExpiryDate, new \DateTimeZone('Asia/Kuwait'));
            $ExpiryDate->modify('+1 day'); ///????????????$ExpiryDate without any hour so for i added the 1 day just in case. this should be changed after adding the tome to the expire date
            $currentDate = new \DateTime('now', new \DateTimeZone('Asia/Kuwait'));

            if ($ExpiryDate < $currentDate) {
                throw new \Exception('Invoice is expired since: ' . $ExpiryDate->format('Y-m-d'), 2); //cancelled order
            }

            //------------------
            //case 3:
            //payment is pending .. user has not paid yet and the invoice is not expired
            throw new \Exception('Payment is pending');
        }

        return $json;
    }


    /**
     * Refund a given Payment
     *
     * @param integer|string $paymentId
     * @param real|string $amount
     * @param string $currencyCode
     * @param string $reason
     * @param integer|string $orderId
     * @return object
     */
    public function refund($paymentId, $amount, $currencyCode, $reason, $orderId) {

        $rate = $this->getCurrencyRate($currencyCode);
        $url  = "$this->apiURL/v2/MakeRefund";

        $postFields = array(
            'KeyType'                 => 'PaymentId',
            'Key'                     => $paymentId,
            'RefundChargeOnCustomer'  => false,
            'ServiceChargeOnCustomer' => false,
            'Amount'                  => $amount / $rate,
            'Comment'                 => $reason,
        );

        return $this->callAPI($url, $postFields, $orderId, 'Make Refund');
    }


    /**
     * Cancel the subscription
     *
     * @param integer|string $orderId
     * @param integer|string $recurringId
     * @return object
     */
    public function cancelSubscribtion($orderId, $recurringId) {

        $url = $this->apiURL . '/v2/CancelRecurringPayment?recurringId=' . urlencode($recurringId);

        return $this->callAPI($url, null, $orderId, 'Cancel Subscribtion'); //__FUNCTION__
    }


}
