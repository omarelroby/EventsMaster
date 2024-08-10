<?php
     function pay($amount = null, $user_id = null, $user_first_name = null,
     $user_last_name = null, $user_email = null, $user_phone = null, $source = null)
    {

        $data = http_build_query([
            'entityId' => getEntityId($this->source),
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => 'DB',
            'merchantTransactionId' => uniqid(),
            'billing.street1' => 'riyadh',
            'billing.city' => 'riyadh',
            'billing.state' => 'riyadh',
            'billing.country' => 'SA',
            'billing.postcode' => '123456',
            'customer.email' => $user_email,
            'customer.givenName' => $user_first_name,
            'customer.surname' => $user_last_name,
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('HYPERPAY_URL'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . env('HYPERPAY_TOKEN')
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return [
            'payment_id' => json_decode($responseData)->id
        ];
    }

    /**
     * @param Request $request
     * @return array|string
     */
     function verifyPayment(Request $request)
    {
        $url = $this->hyperpay_url . "/" . $request['id'] . "/payment" . "?entityId=" . $request->entityId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . env('HYPERPAY_TOKEN')
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $final_result = (array)json_decode($responseData, true);
        if (in_array($final_result["result"]["code"], ["000.000.000", "000.100.110", "000.100.111", "000.100.112"])) {
            return [
                'success' => true,
                'payment_id'=>$request['id'],
                'message' => __('PAYMENT_DONE'),
                'data' => $final_result
            ];
        } else {
            return [
                'success' => false,
                'payment_id'=>$request['id'],
                'message' => __('PAYMENT_FAILED_WITH_CODE', ['CODE' => $final_result["result"]["code"]]),
                'process_data' => $final_result
            ];
        }
    }

  

    function getEntityId($source)
    {
        switch ($source) {
            case "CREDIT":
                return  env('hyperpay_credit_id');
            case "MADA":
                return  env('hyperpay_mada_id');
            case "APPLE":
                return  env('hyperpay_apple_id') ;
            default:
                return "";
        }
    }



