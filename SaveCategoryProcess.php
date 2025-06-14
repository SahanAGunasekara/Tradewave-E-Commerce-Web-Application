<?php

require "connection.php";

if (isset($_POST["n"]) && isset($_POST["e"])) {


    $cname = $_POST["n"];
    $umail = $_POST["e"];


    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $umail . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        Database::iud("INSERT INTO `category`(`cat_name`) VALUES ('" . $cname . "')");
        echo ("Success");
    } else {

        echo ("Invalid User");
    }
}
