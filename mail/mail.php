<?php
/**
 * Created by PhpStorm.
 * User: Andrew Quaye
 * Date: 12/09/2018
 * Time: 11:16 AM
 */

header("Content-Type: Application/JSON");

if (!isset($_POST)){
    $msg = "Server Request method failed";
    echo json_encode($msg);
    exit();
}else{
    if(isset($_POST['to'])){
        $to = $_POST['to'];
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)){
            $msg = "invalid email";
        }
    }else{
        $msg = "Email not set";
    }

    if(isset($_POST['from'])){
        $from = $_POST['from'];
        if (!filter_var($from, FILTER_VALIDATE_EMAIL)){
            $msg = "invalid email";
        }
    }else{
        $msg = "Email not set";
    }

    if(isset($_POST['subject'])){
        $subject = $_POST['to'];
        if (!preg_match("/^[a-zA-Z ]*$/", $subject)){
            $msg = "Only letters and white space allowed";
        }
    }else{
        $msg = "Subjection not set";
    }

    if(isset($_POST['message'])){
        $message = $_POST['message'];
    }else{
        $msg = "Message not set";

        $header ="From: $from \r\n";
        $header .= "Content-Type: text/html \r\n";

        $mail = mail($to,$subject,$message,$header);

        if ($mail == TRUE){
            $msg = "msg-sent-".date("d-m-Y H:i:s");
        }else{
            $msg = "error-on-server";
        }

        echo json_encode($msg);
    }

}