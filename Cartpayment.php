

<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){

  
    $umail = $_SESSION["u"]["email"];

    //echo ($umail);

    $array;

    $order_id = uniqid();

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $umail . "'");
$cart_num = $cart_rs->num_rows;

for ($x = 0; $x < $cart_num; $x++) {
    $cart_data = $cart_rs->fetch_assoc();

    $product_rs = Database::search("SELECT * FROM `product` WHERE 
                `id`='" . $cart_data["product_id"] . "'");
    $product_data = $product_rs->fetch_assoc();

    $total = $total + ($product_data["price"] * $cart_data["qty"]);

  
   
}

    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '".$umail."' ");
    $user_data = $user_rs->fetch_assoc();

   

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='".$umail."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){
        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_city_id"];
        $address = $city_data["line1"].",".$city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_district_id"];
        $delivery = 0;

        if($district_id == 13){
            $delivery = $product_data["delivery_fee_local"];
        }else{
            $delivery = $product_data["delivery_fee_international"];
        }

        $item = $product_data["title"];
        $amount = $total;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $user_data["mobile"];
        $uaddress = $address;
        $city = $district_data["city_name"];

        $merchant_id = "0000000"; //Replace your merchant ID
        $merchant_secret = "QWERTYUIOPASDFGHJKL'ZXCVBNM=="; //Replace your merchant secret
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array ["id"] =$order_id;
        $array ["item"] =$item;
        $array ["amount"] =$amount;
        $array ["fname"] =$fname;
        $array ["lname"] =$lname;
        $array ["mobile"] =$mobile;
        $array ["address"] =$uaddress;
        $array ["umail"] =$umail;
        $array ["city"] =$city;
        $array ["hash"] =$hash;

        echo json_encode($array);


    }else{
        echo("2");
    }
}else{
    echo("1");
}


?>