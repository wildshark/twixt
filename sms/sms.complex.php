<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 21/10/2018
 * Time: 6:32 PM
 */


include_once "config.php";

if ($_SESSION['token'] === $_REQUEST['token']){

    if (!isset($_REQUEST['to'])){
        $_json->error ="2101";
        $_json->msg = "Empty field TO";
    }elseif (!isset($_REQUEST['from'])){
        $_json->error ="2102";
        $_json->msg = "Empty field From";
    }elseif (!isset($_REQUEST['msg'])){
        $_json->error ="2103";
        $_json->msg = "Empty field Message";
    }else {
        $request->to = $_REQUEST['to'];
        $request->from = $_REQUEST['from'];
        $request->message = $_REQUEST['msg'];
        $success = $_REQUEST['success'];
        $fail = $_REQUEST['fail'];

        $url = 'http://sms.bernsergsolutions.com:8080/bulksms/bulksms?username=' . USERNAME . '&password=' . PASSWORD;

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS,
            '&type=0&dlr=1&destination=' . $request->to . '&source=' . $request->from . '&message=' . $request->message);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($c);
        curl_close($c);
        // echo  $content;

        $str_total = strlen($content);
        $text = 4 - $str_total;

        $msg = substr($content, 0, $text);

        if ($msg == 1701) {
          $url =  $_REQUEST['success'];
        } else {
            $url =  $_REQUEST['fail'];
        }

        header("location: " . $url);
    }
}else{
    $_json->Error = "2200";
    $_json->msg = "Missing token";
    $my_json_output = json_encode($_json);
    echo $my_json_output;
}
