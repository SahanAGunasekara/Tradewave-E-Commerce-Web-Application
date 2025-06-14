<?php

require "connection.php";

$email = $_POST["e"];
$v_code = $_POST["vc"];

if(empty($v_code)){
    echo ("Please enter verification code.");
}else{

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."' AND 
    `verification_code`='".$v_code."'");

    $n = $rs->num_rows;

    if($n == 1){

        

        echo ("success");

    }else{
        echo ("Invalid user details.");
    }
}

?>