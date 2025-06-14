<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $user = $_SESSION["u"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_local,product.delivery_fee_international,
    product.category_cat_id,product.brand_has_model_id,product.color_color_id,product.status_status_id,
    product.condition_condition_id,product.users_email,model.model_name AS mname,
    brand.brand_name AS bname FROM `product` INNER JOIN `brand_has_model` ON 
    brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON 
    brand.brand_id=brand_has_model.brand_brand_id INNER JOIN `model` ON 
    model.model_id=brand_has_model.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>



        <!DOCTYPE html>

        <html>

        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="resources\logo.png">
            <title>Tradewave | <?php echo $product_data["title"]; ?></title>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />

        </head>

        <body>
            <div class="container-fluid">

                <div class="row">
                    <?php
                    require "header.php";
                    ?>
                    <div class="col-12 col-lg-6 mt-5">

                        <div class="row">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                </ol>
                            </nav>
                        </div>

                        <div class="align-items-center border border-1 border-secondary">
                            <div class="mainimg" id="mainImg"></div>
                        </div>

                        <div class="row mt-2">
                            <?php

                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $pid . "'");
                            $img_num = $img_rs->num_rows;
                            $img_list = array();

                            if ($img_num != 0) {
                                for ($x = 0; $x < $img_num; $x++) {
                                    $img_data = $img_rs->fetch_assoc();
                                    $img_list[$x] = $img_data["img_path"];

                            ?>
                                    <div class="col-3 col-lg-3">
                                        <img src="<?php echo $img_list["$x"]; ?>" id="product_img<?php echo $x; ?>" onclick="changeMainImage(<?php echo $x; ?>);" class="img-thumbnail mt-1 mb-1" />
                                    </div>

                                <?php
                                }
                            } else {
                                ?>
                                <div class="col-3 col-lg-3">
                                    <img src="resources\empty.svg" class="img-thumbnail mt-1 mb-1" />
                                </div>
                                <div class="col-3 col-lg-3">
                                    <img src="resources\empty.svg" class="img-thumbnail mt-1 mb-1" />
                                </div>
                                <div class="col-3 col-lg-3">
                                    <img src="resources\empty.svg" class="img-thumbnail mt-1 mb-1" />
                                </div>
                                <div class="col-3 col-lg-3">
                                    <img src="resources\empty.svg" class="img-thumbnail mt-1 mb-1" />
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        $price = $product_data["price"];
                        $add = ($price / 100) * 10;
                        $new_price = $price + $add;
                        $diff = $new_price - $price;
                        $percentage = ($diff / $price) * 100;


                        ?>

                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <div class="col-12 col-lg-6">
                            <h2 class="fw-bold"> <?php echo $product_data["title"]; ?></h2>
                        </div>
                        <div class="row">
                            <div class="col-6 col-lg-3 mt-3">
                                <h4><span class="fs-4 text-dark fw-bold">Rs. <?php echo $price; ?>.00</span>
                                    
                                    <span class="fs-4 text-danger fw-bold text-decoration-line-through">Rs. <?php echo $new_price; ?>.00</span>
                                    
                                    <span class="fs-4 fw-bold text-black-50">Save Rs.<?php echo $diff; ?>.00 (<?php echo $percentage; ?>%)</span>
                                </h4>
                                <p class="mt-2 mb-2"><i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                </p>
                            </div>
                            <div class="col-6 col-lg-3 mt-1">
                                <label class="btn btn-light fs-5" onclick="addTowatchlist(<?php echo $product_data['id']; ?>);"> <i class="bi bi-heart"></i> Wishlist</label>
                                <p>32/5 | 8257 reviews</p>

                            </div>


                        </div>
                        <div class="row mt-4">
                            <?php
                            $color_rs = Database::search("SELECT * FROM `color` INNER JOIN `product` ON color.`color_id`=product.`color_color_id` WHERE product.`id`= '" . $pid . "'");
                            $color_data = $color_rs->fetch_assoc();
                            ?>
                            <div class="col-6 col-lg-3 ">
                                <p>Color : <?php echo $color_data["color_name"]; ?></p>
                                <p><i class="bi bi-circle-fill"></i>
                                    <i class="bi bi-circle-fill text-primary"></i>
                                    <i class="bi bi-circle-fill text-success"></i>
                                    <i class="bi bi-circle-fill text-danger"></i>
                                    <i class="bi bi-circle-fill text-warning"></i>
                                </p>
                            </div>
                            <div class="col-6 col-lg-6 ">
                                <p>Quantity :

                                <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                                    <div class="col-6 col-lg-4">

                                        <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[1-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />

                                        <div class="position-absolute qty-buttons">
                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                border border-1 border-secondary qty-inc">
                                                <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                            </div>
                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                                <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec();'></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </p>

                            </div>


                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-lg-6">
                                <label class="btn btn-dark text-light" onclick="addToCart(<?php echo $product_data['id']; ?>);"> Add to cart ></label>

                            </div>


                        </div>
                        <div class="row mt-5">
                            <div class="col-3 col-lg-3">
                                <p>About</p>
                            </div>
                            <div class="col-9 col-lg-7">
                                <p><?php echo $product_data["description"]; ?></p>
                            </div>

                        </div>
                        <div class="row mt-5">
                            <?php
                            $model_rs = Database::search("SELECT * FROM `model` INNER JOIN `brand_has_model` ON model.`model_id`=brand_has_model.`model_model_id` INNER JOIN `product` ON product.`brand_has_model_id`=brand_has_model.`id` WHERE product.id= '" . $pid . "'");
                            $model_data = $model_rs->fetch_assoc();

                            $brand_rs = Database::search("SELECT * FROM `brand` INNER JOIN `brand_has_category` ON brand.`brand_id`=brand_has_category.`brand_brand_id` INNER JOIN `product` ON product.`category_cat_id`=brand_has_category.`id` WHERE product.id= '" . $pid . "'");
                            $brand_data = $brand_rs->fetch_assoc();
                            ?>
                            <div class="col-3 col-lg-3">
                                <p>Specifics</p>
                            </div>
                            <div class="col-9 col-lg-7">
                                <p>Brand :<b> <?php echo $brand_data["brand_name"]; ?></b></p>
                                <p>Model :<b> <?php echo $model_data["model_name"]; ?></b></p>
                                <p>Weight :<b> 250 g</b></p>
                                <p>Height :<b> 6.2 inches</b></p>
                                <p>Available : <b><?php echo $product_data["qty"]; ?> Items</b></p>

                            </div>

                        </div>

                        <div class="row mb-3 mt-3 justify-content-center">
                            <div class="col-12">
                                <label class="btn btn-success" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Pay Now</label>
                            </div>

                        </div>


                    </div>

                </div>
                <hr class="fw-bold text-dark fs-1" />

                <div class="row">
                    <h2>Related Items</h2>

                    <div class="row  gap-4" style="margin-top: 20px;">


                        <?php
                        $related_rs = Database::search("SELECT * FROM `product` WHERE 
                                        `brand_has_model_id`= '" . $product_data["brand_has_model_id"] . "'");
                        $related_num = $related_rs->num_rows;

                        for ($x = 0; $x < $related_num; $x++) {
                            $related_data = $related_rs->fetch_assoc()
                        ?>

                            <div class="card col-12 col-lg-3" style="width: 18rem;">
                                <?php
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $related_data["id"] . "'");

                                $img_data = $img_rs->fetch_assoc();

                                $con_rs = Database::search("SELECT  `condition_name` FROM `condition` INNER JOIN `product` ON condition.condition_id=product.condition_condition_id");
                                $con_data = $con_rs->fetch_assoc();

                                $status_rs = Database::search("SELECT `status_name` FROM `status` INNER JOIN `product` ON status.status_id=product.status_status_id");
                                $status_data = $status_rs->fetch_assoc();
                                ?>
                                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold fs-6"><?php echo $related_data["title"]; ?></h5>
                                    <span class="badge rounded-pill text-bg-info"><?php echo $con_data["condition_name"]; ?></span><br />
                                    <span class="card-text text-primary">Rs.<?php echo $related_data["price"]; ?></span><br />
                                    <span class="card-text text-warning fw-bold"><?php echo $status_data["status_name"]; ?></span><br />
                                    <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                    <a href="<?php echo "singleproductview.php?id=" . ($related_data["id"]); ?>" class="col-12 btn btn-success">Pay Now</a>

                                </div>
                            </div>
                        <?php
                        }

                        ?>




                    </div>




                </div>

                <?php
                require "footer.php";
                ?>


            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="sweetalert.min.js"></script>
        </body>

        </html>

    <?php
    } else {
    ?>
        <script>
            alert("Something went wrong");
        </script>
<?php
    }
}


?>