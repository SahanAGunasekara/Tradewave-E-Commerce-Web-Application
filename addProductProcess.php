<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["clr"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$dfi = $_POST["dfi"];
$desc = $_POST["desc"];

if($category == "0"){
    echo ("Please select a Category");
}else if($brand == "0"){
    echo ("Please select a Brand");
}else if($model == "0"){
    echo ("Please select a Model");
}else if(empty($title)){
    echo ("Please add the Title");
}else if(strlen($title) >= 100){
    echo ("Title should have less than 100 characters");
}else if ($condition == "0"){
    echo ("Please select a Condition");
}else if ($clr == "0"){
    echo ("Please select a Colour");
}else if(empty($qty)){
    echo ("Please add the Quantity");
}else if($qty == "0" | $qty == "e" | $qty < 0){
    echo ("Invalid value for field Quantity");
}else if(empty($cost)){
    echo ("Please add the Cost");
}else if(!is_numeric($cost)){
    echo ("Invalid value for field Cost Per Item");
}else if(empty($dwc)){
    echo ("Please add the Cost for Delivery within Country");
}else if(!is_numeric($dwc)){
    echo ("Invalid value for field Delivery within Country");
}else if(empty($dfi)){
    echo ("Please add the Cost for Delivery International");
}else if(!is_numeric($dfi)){
    echo ("Invalid value for field Delivery cost International");
}else if(empty($desc)){
    echo ("Please add the Description");
}else{

$mhb_rs = Database::search("SELECT * FROM `brand_has_model` WHERE 
                        `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");

$mhb_id ;

if($mhb_rs->num_rows > 0){

    $mhb_data = $mhb_rs->fetch_assoc();
    $mhb_id = $mhb_data["id"];

}else{

    Database::iud("INSERT INTO `brand_has_model`(`model_model_id`,`brand_brand_id`) 
                    VALUES ('".$model."','".$brand."')");

    $mhb_id = Database::$connection->insert_id;

}

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_local`,
    `delivery_fee_international`,`category_cat_id`,`brand_has_model_id`,`color_color_id`,`status_status_id`,`condition_condition_id`,`users_email`) 
    VALUES ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$dwc."','".$dfi."','".$category."',
    '".$mhb_id."','".$clr."','".$status."','".$condition."','".$email."')");

    //echo ("Product Added Successfully.");

$product_id = Database::$connection->insert_id;

$length = sizeof($_FILES);

if($length <= 3 && $length > 0){

    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["img".$x])){

            $img_file = $_FILES["img".$x];
            $file_extention = $img_file["type"];

            if(in_array($file_extention,$allowed_img_extentions)){

                $new_img_extention;

                if($file_extention == "image/jpg"){
                    $new_img_extention = ".jpg";
                }else if($file_extention == "image/jpeg"){
                    $new_img_extention = ".jpeg";
                }else if($file_extention == "image/png"){
                    $new_img_extention = ".png";
                }else if($file_extention == "image/svg+xml"){
                    $new_img_extention = ".svg";
                }

                $file_name = "resources//products//".$title."_".$x."_".uniqid().$new_img_extention;
                move_uploaded_file($img_file["tmp_name"],$file_name);

                Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) 
                                VALUES ('".$file_name."','".$product_id."')");

                

            }else{
                echo ("Not an allowed image type.");
            }

        }
    }

    echo ("Product Added Succesfully");

}else{
    echo ("Invalid Image Count");
}

}

?>