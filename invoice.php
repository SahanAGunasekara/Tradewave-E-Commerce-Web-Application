<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources\logo.png">
    <title>Tradewave | Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <?php
    session_start();
    require "connection.php";

    if (isset($_SESSION["u"])) {
        $umail = $_SESSION["u"]["email"];
        $oid = $_GET["id"];

    ?>
        <?php include "header.php"; ?>

        <div class="container-fluid">
            <div id="page">
                <div style="background-color: #592693;" class=" p-5">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <img src="resources\logo.png" style="height: 70px;" />
                            <h1 class="text-light mt-2">Invoice</h1>
                        </div>
                        <div class="col-6 col-lg-6 text-light text-end">
                            <h1 class="mt-2">TradeWave</h1>
                            <h4 class="mt-2">Maradana ,Colombo 26</h4>
                            <h4 class="mt-2">Sri Lanka</h4>
                            <h4 class="mt-2">60096</h4>
                        </div>

                    </div>


                </div>
                <div class="">
                    <div class="row p-5">
                        <?php
                        $user_rs = Database::search("SELECT * FROM `users` INNER JOIN `invoice` ON users.`email`=invoice.`users_email` WHERE invoice.order_id='" . $oid . "'");
                        $user_data = $user_rs->fetch_assoc();

                        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON  
                                    user_has_address.city_city_id=city.city_id INNER JOIN 
                                    `district` ON city.district_district_id=district.district_id 
                                    INNER JOIN `province` ON 
                                    district.province_province_id=province.province_id 
                                    WHERE `users_email`='" . $umail . "'");

                        $address_data = $address_rs->fetch_assoc();

                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                        $invoice_data = $invoice_rs->fetch_assoc();

                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `invoice` ON product.`id`=invoice.`product_id` WHERE invoice.order_id='" . $oid . "'");
                        $product_data = $product_rs->fetch_assoc();

                        $price = $product_data["price"];
                        $total = $invoice_data["qty"] * $price;
                        $final = $total + 1400;

                        ?>
                        <div class="col-6 col-lg-6">
                            <P>BILL TO:</P>
                            <h3><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h3>
                            <p><?php echo $address_data["line1"] . ", " . $address_data["line2"]; ?></p>
                            <p><?php echo $address_data["province_name"]; ?></p>
                            <p><?php echo $address_data["district_name"]; ?></p>
                            <p><?php echo $address_data["city_name"]; ?></p>
                            <p>Sri Lanka</p>
                            <p><?php echo $address_data["postal_code"]; ?></p>
                        </div>
                        <div class="col-6 col-lg-6 text-end ">
                            <p><b>INVOICE #</b></p>
                            <p><?php echo $oid ?></p>
                            <p class="mt-2"><b>DATE</b></p>
                            <p><?php echo $invoice_data["date"]; ?></p>
                            <p class="mt-2"><b>INVOICE DUE DATE</b></p>
                            <p>12/31/26</p>
                        </div>

                    </div>
                </div>
                <hr class="p-5 text-dark" />
                <div class="col-12 col-lg-12">
                    <table class="table">
                        <thead>
                            <tr class="border border-1 border-secondary">
                                <th>#</th>
                                <th>Order ID & Product</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height: 72px;">
                                <td class="bg-primary text-white fs-3">01</td>
                                <td>
                                    <span class="fw-bold text-primary text-decoration-underline p-2"><?php echo $oid ?></span><br />
                                    <span class="fw-bold text-primary fs-3 p-2"><?php echo $product_data["title"]; ?></span>
                                </td>
                                <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs. <?php echo $product_data["price"]; ?>.00</td>
                                <td class="fw-bold fs-6 text-end pt-3"><?php echo $invoice_data["qty"]; ?></td>
                                <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs. <?php echo $total ?>.00</td>
                            </tr>
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="3" class="border-0"></td>
                                <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                <td class="text-end">Rs. <?php echo $total ?> .00</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border-0"></td>
                                <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                <td class="text-end border-primary">Rs. 1400 .00</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border-0"></td>
                                <td class="fs-5 text-end fw-bold border-primary text-primary">GRAND TOTAL</td>
                                <td class="fs-5 text-end fw-bold border-primary text-primary">Rs. <?php echo $final ?> .00</td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
                <div class="col-12 col-lg-6">
                    <button class="btn btn-danger mt-2 mb-2"><i class=" bi-printer-fill" onclick="window.print();"> Print Invoice</i></button>
                    <button class="btn btn-success mt-2 mb-2"><i class=" bi-download" onclick="printinvoice();"> Save Invoice</i></button>
                </div>
            </div>

        </div>
        <?php require "footer.php"; ?>


    <?php
    }

    ?>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>