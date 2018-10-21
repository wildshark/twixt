<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 21/10/2018
 * Time: 3:07 PM
 */
header("Content-Type: Application/JSON");
$_json = new stdClass();
session_start();

if ($_REQUEST['api'] ==="sms") {
    require_once "sms/sms.php";
}elseif($_REQUEST['api'] === "sms-token") {
    $token = uniqid();
    $_SERVER['token'] = $token;
    $_json->Token = $toke;
    echo json_encode($_json);
}elseif ($_REQUEST['api'] ==='sms-complex'){
    require_once "sms/sms.complex.php";
}else{
    $_json->error = "404";
    $_json->msg ="Missing function";
    echo json_encode($_json);

}