<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 21/10/2018
 * Time: 3:07 PM
 */
header("Content-Type: Application/JSON");
$_json = new stdClass();

if ($_GET['api'] ==="sms"){
    require_once "sms/sms.php";
}else{
    $_json->error = "404";
    $_json->msg ="Missing function";
    echo json_encode($_json);

}