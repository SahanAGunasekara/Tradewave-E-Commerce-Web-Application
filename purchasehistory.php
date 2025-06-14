<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];
?>
    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources\logo.png">
        <title>Tradewave | Admin | Manage Users</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="">
        <div class="container-fluid">
           
            <?php require "header.php"?>
           

            <div class="row justify-content-center mt-5" id="page">
                <div class="col-12 col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Order id</th>
                                <th scope="col" class="text-center">Purchase Date</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">qty</th>
                                <th scope="col" class="text-center">Item</th>
                                <th scope="col" class="text-center">Item Name</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM `invoice`WHERE `users_email`='". $email. "'");
                            $invoice_num = $invoice_rs->num_rows;

                            


                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `invoice` ON  product.id = invoice.product_id  
                                WHERE invoice.product_id='" . $invoice_data["product_id"] . "'");
                                
                                $product_data = $product_rs->fetch_assoc();
                            ?>
                                <tr>
                                <?php
                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();
                                    ?>

                                    <th scope="row" class="text-center"><?php echo $x + 1; ?></th>
                                    <td class="text-center">
                                    <?php echo $invoice_data["order_id"]; ?>
                                    </td>

                                    <td class="text-center"><?php echo $invoice_data["date"]; ?></td>
                                    <td class="text-center">Rs.<?php echo $invoice_data["total"]; ?>.00</td>
                                    <td class="text-center"><?php echo $invoice_data["qty"]; ?></td>
                                    <td class="text-center"><img src="<?php echo $img_data["img_path"]; ?>" width="50px" height="50px" class="rounded-circle" /></td>
                                    
                                    <td class="text-center">
                                    <?php echo $product_data["title"]; ?>
                                    </td>

                                    <!--model-->
                                </tr>

                            <?php
                            }


                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="col-12 col-lg-6 mt-3 text-end">
                <button class="btn btn-danger mt-2 mb-2"><i class=" bi-printer-fill" onclick="printinvoice();"> Print OrderHistory</i></button>


            </div>

        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php

} else {
    echo ("Please Signup Again!!");
}

?>