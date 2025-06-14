<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources\logo.png" />

</head>

<body class="bdy">
    <?php require "header.php"; ?>
    <div class="container-fluid">

        <div class="row justify-content-center" style="margin-top: 10px;">
            <div class="col-12 col-lg-5">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" id="t">
                    <label class="btn btn-outline-light"  onclick="advancedSearch(0);">Search</label>
                </form>
            </div>


        </div>
        <div class="row justify-content-center" style="margin-top: 30px;">
            <div class="col-12 col-lg-8 rounded" style="background-color: white;">
                <div class="row justify-content-center" style="margin-top: 10px;">

                    <div class="col-12 col-lg-3">
                        <select class="form-select" id="category" onclick="loadBrands();">
                            <option value="0">Select Category</option>
                            <?php



                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>

                    </div>
                    <div class="col-12 col-lg-4">
                        <select class="form-select" id="brand" onclick="loadModel();">
                            <option value="0">Select Brand</option>
                            <?php

                            $brand_rs = Database::search("SELECT * FROM `brand`");
                            $brand_num = $brand_rs->num_rows;

                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>

                    </div>

                    <div class="col-12 col-lg-3">
                        <select class="form-select" id="model">
                            <option value="0">Select Model</option>
                            <?php

                            $model_rs = Database::search("SELECT * FROM `model`");
                            $model_num = $model_rs->num_rows;

                            for ($x = 0; $x < $model_num; $x++) {
                                $model_data = $model_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>

                    </div>

                    <div class="col-12 col-lg-2">
                        <button class="btn " onclick="clearSort();"><i class="bi bi-trash3"></i></button>

                    </div>



                </div>

                <div class="row justify-content-center" style="margin-top: 30px;">

                    <div class="col-12 col-lg-5">
                        <select class="form-select" id="condition">
                            <option value="0">Select condition</option>
                            <?php

                            $condition_rs = Database::search("SELECT * FROM `condition`");
                            $condition_num = $condition_rs->num_rows;

                            for ($x = 0; $x < $condition_num; $x++) {
                                $condition_data = $condition_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>

                    </div>
                    <div class="col-12 col-lg-5">
                        <select class="form-select" id="color">
                            <option value="0">Select color</option>
                            <?php

                            $color_rs = Database::search("SELECT * FROM `color`");
                            $color_num = $color_rs->num_rows;

                            for ($x = 0; $x < $color_num; $x++) {
                                $color_data = $color_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $color_data["color_id"]; ?>"><?php echo $color_data["color_name"]; ?></option>

                            <?php
                            }

                            ?>
                        </select>

                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="btn " type="reset" onclick="clearSort();"><i class="bi bi-trash3"></i></button>

                    </div>




                </div>

                <div class="row justify-content-center" style="margin-top: 30px;">

                    <div class="col-12 col-lg-5">
                        <input type="text" class="form-control" placeholder="Price From..." id="pf">

                    </div>
                    <div class="col-12 col-lg-5">
                        <input type="text" class="form-control" placeholder="Price To..." id="pt">

                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="btn " onclick="clearSort();"><i class="bi bi-trash3"></i></button>

                    </div>




                </div>
                <div class="row justify-content-center" style="margin-top: 30px; margin-bottom:10px;">
                    <div>
                        <div class="row">
                            <div class="col-12 col-lg-10 text-center">
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark" id="s">
                                    <option value="0">SORT BY</option>
                                    <option value="1">PRICE LOW TO HIGH</option>
                                    <option value="2">PRICE HIGH TO LOW</option>
                                    <option value="3">QUANTITY LOW TO HIGH</option>
                                    <option value="4">QUANTITY HIGH TO LOW</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3 mt-4">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <?php require "footer.php"; ?>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>