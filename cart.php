<?php

require "connection.php";
session_start();

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;
    $Rtotal = 0;
    $ntotal = 0;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cart | eShop</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources\logo.png" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php require "header.php"; ?>
                <div class="row" style="margin-top: 10px;">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>

                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <h1 style="color: white;">Cart <i class="bi bi-cart4"></i></h1>
                    </div>

                </div>
                <?php

                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
                $cart_num = $cart_rs->num_rows;

                if ($cart_num == 0) {
                ?>
                    <!-- Empty View -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptyCart"></div>
                            <div class="col-12 text-center mb-2">
                                <label class="form-label fs-1 fw-bold">
                                    You have no items in your Cart yet.
                                </label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Empty View -->

                <?php
                } else {
                ?>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-12 col-lg-8">
                            <div class="card mb-3 mx-0 col-12" style="padding: 10px; background-color: White;">
                                <div class="row g-0">
                                    <?php
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                                `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT district.district_id AS `did` FROM 
                                    `user_has_address` INNER JOIN `city` ON 
                                    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `users_email`='" . $user . "'");

                                        $address_data = $address_rs->fetch_assoc();

                                        $color_rs = Database::search("SELECT * FROM `color` INNER JOIN `product` ON color.color_id=product.color_color_id");
                                        $color_data = $color_rs->fetch_assoc();

                                        $condition_rs = Database::search("SELECT * FROM `condition` INNER JOIN `product` ON condition.condition_id=product.condition_condition_id");
                                        $condition_data = $condition_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 13) {
                                            $ship = $product_data["delivery_fee_local"];
                                            $shipping = $shipping + $product_data["delivery_fee_local"];
                                        } else {
                                            $ship = $product_data["delivery_fee_international"];
                                            $shipping = $shipping + $product_data["delivery_fee_international"];
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");

                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . "   " . $seller_data["lname"];
                                    ?>
                                        <div class="col-md-12 mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="fw-bold text-black-50 fs-5">Seller :<?php echo $seller ?></span>&nbsp;
                                                    <span class="fw-bold text-black fs-5"></span>&nbsp;
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- popup -->
                                        <div class="col-md-4">

                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Product Description" title="<?php echo $product_data["description"]; ?>">
                                                <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                            </span>

                                        </div>
                                        <!-- popup -->
                                        <div class="col-md-5">
                                            <div class="card-body">

                                                <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                <span class="fw-bold text-black-50">Colour :<?php echo $color_data["color_name"]; ?> </span> &nbsp; |

                                                &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $condition_data["condition_name"]; ?> </span>
                                                <br>
                                                <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                <span class="fw-bold text-black fs-5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                <br>
                                                <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="10">
                                                <br><br>
                                                <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                <span class="fw-bold text-black fs-5">Rs.<?php echo $shipping; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-body d-grid">
                                                <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                <a class="btn btn-outline-danger mb-2" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-12 mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-6 col-md-6">
                                                    <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                </div>
                                                <?php
                                            $Rtotal = ($product_data["price"] * $cart_data["qty"]);
                                            $ntotal = ($total + $shipping);
                                                ?>
                                                <div class="col-6 col-md-6 text-end">
                                                    <span class="fw-bold fs-5 text-black-50">Rs.<?php echo $Rtotal?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                        </div>
                    <?php

                                    }

                    ?>
                    <div class="col-12 col-lg-4 rounded shadow " style="padding: 10px;">

                        <div class="card">
                            <div class="card-header">
                                Order Summary
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Sub Total(<?php echo $cart_num; ?> items)</h5>
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Enter Voucher Code" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Apply</button>
                                </form>
                                <hr />
                                <div class="row">
                                    <div class="col-6">
                                        Total
                                    </div>
                                    <div class="col-6">
                                        Rs.<?php echo $total; ?>.00
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        Shipping
                                    </div>
                                    <div class="col-6">
                                        Rs.<?php echo $shipping; ?>.00
                                    </div>

                                </div>
                                <div class="col-12" style="align-items:center;">
                                    <button class=" btn btn-primary" onclick="checkout();">CHECKOUT</button>
                                </div>
                            </div>
                        </div>



                    </div>


                    </div>

                <?php
                }
                ?>






                <?php require "footer.php"; ?>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>

<?php

} else {
}

?>