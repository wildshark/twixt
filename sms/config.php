<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 12/09/2018
 * Time: 7:30 PM
 */

header("Content-Type: Application/JSON");
$_json = new stdClass();
$respone = new stdClass();
$bulksms = new stdClass();
$request = new stdClass();

//username from SMSAPI

define("USERNAME",'bsgh-iquipe');
define("PASSWORD",'passwd82');

