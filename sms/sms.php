<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 12/09/2018
 * Time: 7:30 PM
 */

if (!file_exists("sms/config.php")){
    $_json->error ="2100";
    $_json->msg = "Server config file missing";
}else{
    include "config.php";

    if (!isset($_REQUEST['to'])){
        $_json->error ="2101";
        $_json->msg = "Empty field TO";
    }elseif (!isset($_REQUEST['from'])){
        $_json->error ="2102";
        $_json->msg = "Empty field From";
    }elseif (!isset($_REQUEST['msg'])){
        $_json->error ="2103";
        $_json->msg = "Empty field Message";
    }else{
        $request->to = $_REQUEST['to'];
//sender name has to be active
        $request->from = $_REQUEST['from'];
//message content
        $request->message = $_REQUEST['msg'];
//API http

       $url = 'http://sms.bernsergsolutions.com:8080/bulksms/bulksms?username='.USERNAME.'&password='.PASSWORD;

        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$url);
        curl_setopt($c,CURLOPT_POST,true);
        curl_setopt($c,CURLOPT_POSTFIELDS,
            '&type=0&dlr=1&destination='.$request->to.'&source='.$request->from.'&message='.$request->message);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
        $content = curl_exec($c);
        curl_close($c);
        // echo  $content;

        $str_total = strlen($content);
        $text = 4 - $str_total;

        $msg = substr($content,0,$text);

        if ($msg == 1701){

            $_json->Status = "successful";
            $_json->code = "1701";
            $_json->to = $request->to;
            $_json->from = $request->from;

        }else{

            $_json->Status = "Failed";
            $_json->code = "1702";
            $_json->to = $request->to;
            $_json->from = $request->from;

        }

        $my_json_output = json_encode($_json);
        echo $my_json_output;
    }

}
