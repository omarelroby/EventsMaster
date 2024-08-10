<?php


function sendSms($number, $msg)
{


 $headers = array(
        'Content-Type: application/json'
    );
$body = array(
        'userName' => env('SMS_USERNAME'),
        'numbers' => $number,
        'userSender' => env('SMS_USERSENDER'),
        'apiKey' =>  env('SMS_API_KEY'),
        'msg'   => $msg
    );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, $headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
return $response;
}

function getMessage($number, $bulkid , $limit)
{


 $headers = array(
        'Content-Type: application/json'
    );
$body = array(
        'userName' => env('SMS_USERNAME'),
        'numbers' => $number,
        'apiKey' =>  env('SMS_API_KEY'),
        "reqBulkId"=> $bulkid,
	    "pageNumber"=>"1",
        "limit"=>$limit
    );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/getMessages.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, $headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
return $response;
}

function sendSmsOTP($number, $msg, $lang)
{


 $headers = array(
        'Content-Type: application/json',
         'lang:'.$lang
    );
$body = array(
        'userName' => env('SMS_USERNAME'),
        'numbers' => $number,
        'userSender' => env('SMS_USERSENDER'),
        'apiKey' =>  env('SMS_API_KEY')
       );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendOTPCode.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, $headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
return $response;
}



function verifyOTPCode($number, $msg, $lang , $code)
{


 $headers = array(
        'Content-Type: application/json',
        'lang:'.$lang
    );
$body = array(
        'userName' => env('SMS_USERNAME'),
        'numbers' => $number,
        'code'  => $code,
        'userSender' => env('SMS_USERSENDER'),
        'apiKey' =>  env('SMS_API_KEY')
       );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/verifyOTPCode.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, $headers);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
return $response;
}
