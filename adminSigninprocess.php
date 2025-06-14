<?php

session_start();

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email2"];
$password = $_POST["pasw1"];


if(empty($email)){
    echo ("Please enter your Email Address.");
}else if(strlen($email) > 100){
    echo ("Incorrect Email Address.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Not a valid Email Address.");
}else if(empty($password)){
    echo ("Please enter your Password.");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo ("Incorrect password.");
}else{

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."' AND 
    `password`='".$password."'");

    $n = $rs->num_rows;

    if($n == 1){

        
        $d = $rs->fetch_assoc();
        $_SESSION["au"] = $d;

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dakalankagunasekara2003@gmail.com';
            $mail->Password = 'ldlc jvyu kidl wuyw';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('dakalankagunasekara2003@gmail.com', 'Reset Password');
            $mail->addReplyTo('dakalankagunasekara2003@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Tradewave Admin Verification Code';
            $bodyContent = '<h1 style="color:green;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo ("Verification Code Sending Failed.");
            }else{
                echo ("success");
            }

      

    }else{
        echo ("Invalid Email Address or Password");
    }

}

?>