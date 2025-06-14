<?php


require "connection.php";

$color = $_POST["color"];


$color_rs = Database::search("SELECT `color_name` FROM `color` WHERE `color_name`='" . $color. "'"); 

$color_num = $color_rs->num_rows;

if($color_num == 1){
   echo ("select color from the list");
}else{
    Database::iud("INSERT INTO `color`(`color_name`) VALUES ('" . $color . "') ");
    echo ("Color Successfully added. select from the list");
}


?>