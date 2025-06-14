<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources\logo.png">
        <title>Tradewave | Watch List</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="bdy">
        <?php require "header.php"; ?>
        <div class="col-12 col-lg-12" style="border-style: solid; border-color:blue; border-radius:8px; padding:10px;">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <h1 class="text-light">WATCH LIST <i class="bi bi-sunglasses"></i></h1>
                    <div class="col-9 col-lg-9">
                        <hr />
                    </div>

                </div>

            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-5">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search on Watchlist" id="t">
                        <label class="btn btn-primary" >Search</label>
                    </form>
                </div>
                <div class="col-10 col-lg-10">
                    <hr />
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                            </ol>
                        </nav>
                    </div>

                </div>

            </div>
            <div class="row justify-content-center" style="margin-bottom: 30px;">
                <div class="">
                    <?php
                    $watclist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                `users_email`='" . $_SESSION["u"]["email"] . "'");
                    $watchlist_num = $watclist_rs->num_rows;

                    if ($watchlist_num == 0) {
                    ?>
                        <!-- empty view -->
                        <div class="col-12 col-lg-9">
                            <div class="row">
                                <div class="col-12 emptyView"></div>
                                <div class="col-12 text-center">
                                    <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                </div>
                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                </div>
                            </div>
                        </div>
                        <!-- empty view -->
                    <?php
                    } else {
                    ?>
                        <div class="row justify-content-center gap-4" style="margin-top: 20px;">


                            <?php
                            $watclist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                `users_email`='" . $_SESSION["u"]["email"] . "'");
                            $watchlist_num = $watclist_rs->num_rows;

                            for ($x = 0; $x < $watchlist_num; $x++) {
                                $watchlist_data = $watclist_rs->fetch_assoc();
                            ?>

                                <div class="card col-12 col-lg-3" style="width: 18rem;">
                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watchlist_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");

                                    $seller_data = $seller_rs->fetch_assoc();
                                    $seller = $seller_data["fname"] . "   " . $seller_data["lname"];

                                    $color_rs = Database::search("SELECT * FROM `color` INNER JOIN `product` ON color.color_id=product.color_color_id");
                                    $color_data = $color_rs->fetch_assoc();

                                    $condition_rs = Database::search("SELECT * FROM `condition` INNER JOIN `product` ON condition.condition_id=product.condition_condition_id");
                                    $condition_data = $condition_rs->fetch_assoc();

                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();


                                    ?>
                                    <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h3 class="card-title fw-bold text-primary"><?php echo $product_data["title"]; ?></h3>
                                        <span class="card-text text-warning fw-bold" style="color: black;">Colour : <?php echo $color_data["color_name"]; ?></span><br />
                                        <span class="badge rounded-pill text-bg-info"><?php echo $condition_data["condition_name"]; ?></span><br />
                                        <span class="card-text text-primary">Rs.<?php echo $product_data["price"]; ?></span><br />
                                        <span class="card-text text-warning fw-bold">Quantity : <?php echo $product_data["qty"]; ?> Items Available</span><br />
                                        <span class="card-text text-success fw-bold">Seller : <?php echo $seller; ?></span><br />
                                        <a href="<?php echo "singleproductview.php?id=" . ($product_data["id"]); ?>" class="col-12 btn btn-outline-success">Buy Now</a>
                                        <button class="col-12 btn btn-outline-info mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                                            <i class="bi bi-cart4 text text-black fs-5"></i>
                                        </button>
                                        <button onclick="removefromwatchlist(<?php echo $watchlist_data['id']; ?>);" class="col-12 btn btn-outline-danger mt-2 border border-danger">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>




                        <?php
                    }

                        ?>


                        </div>

                </div>

            </div>

            <?php require "footer.php"; ?>
            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
    </body>

    </html>


<?php

} else {
}

?>