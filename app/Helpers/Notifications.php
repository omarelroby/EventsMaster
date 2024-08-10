<?php

// Firebase notification code

function firebase_notification($title, $body, $tokens, $click_action)
{
    $registrationIDs = $tokens;
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'click_action' => $click_action,
        'sound' => "default",
        'color' => "#203E78"
    );

    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg
    );

    $headers = array(
        'Authorization: key=' . env('FCM_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function firebase_chat_notification($title, $body, $tokens, $click_action, $data = [])
{

    $registrationIDs = $tokens;

    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'click_action' => $click_action,
        'sound' => "default",
        'color' => "#203E78"
    );

    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data'=>$data
    );

    $headers = array(
        'Authorization: key=' . env('FCM_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
