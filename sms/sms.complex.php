<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 21/10/2018
 * Time: 6:32 PM
 */

include_once "sms/config.php";

if ($_SESSION['token'] === $_REQUEST['token']){
   $to = $_REQUEST['to'];
   $from = $_REQUEST['from'];
   $msg = $_REQUEST['msg'];
   $success = $_REQUEST['success'];
   $fail = $_REQUEST['fail'];

}else{
    $_json->Error = "2200";
    $_json->msg = "Missing token";
    $my_json_output = json_encode($_json);
    echo $my_json_output;
};