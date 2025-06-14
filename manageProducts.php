<?php
session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

    $email = $_SESSION["au"]["email"];
?>
    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources\logo.png">
        <title>Tradewave | Admin | Manage Products</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12 bg-primary text-center">
                    <div class="mt-2 mb-2">
                        <h1 class="" style="color:white;">Manage Products</h1>
                    </div>
                </div>

            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-5">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search Products" id="t">
                        <label class="btn btn-primary col-4 col-lg-4">Search</label>
                    </form>
                </div>
                <div class="col-10 col-lg-10">
                    <hr />
                </div>

            </div>

            <div class="row justify-content-center mt-4" id="page">
                <div class="col-12 col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Product Image</th>
                                <th scope="col" class="text-center">Title</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Registered date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product_rs = Database::search("SELECT * FROM `product` WHERE `status_status_id`='1' ORDER BY `datetime_added`");
                            $product_num = $product_rs->num_rows;


                            for ($x = 0; $x < $product_num; $x++) {
                                $product_data = $product_rs->fetch_assoc();
                            ?>
                                <tr>
                                    <?php
                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();
                                    ?>
                                    <th scope="row" class="text-center"><?php echo $x + 1; ?></th>
                                    <td class="text-center"><img src="<?php echo $img_data["img_path"]; ?>" width="50px" height="50px" class="rounded-circle" /></td>
                                    <td class="text-center"><?php echo $product_data["title"] ?></td>
                                    <td class="text-center">Rs.<?php echo $product_data["price"] ?></td>
                                    <td class="text-center"><?php echo $product_data["qty"] ?></td>
                                    <td class="text-center"><?php echo $product_data["datetime_added"] ?></td>

                                </tr>

                            <?php
                            }


                            ?>
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="col-12 col-lg-6 mt-3 text-end">
            <button class="btn btn-danger mt-2 mb-2"><i class=" bi-printer-fill" onclick="printinvoice();"> Get Report</i></button>
                    

            </div>

            <hr />

            <div class="row justify-content-center mt-4">
                <div class="col-12 text-center">
                    <h3 class="text-black-50 fw-bold">Manage Categories</h3>
                </div>

                <div class="col-12 mb-3">
                    <div class="row gap-1 justify-content-center">

                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;
                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-danger rounded" style="height: 50px;">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <label class="form-label fw-bold fs-5"><?php echo $category_data["cat_name"]; ?></label>
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <label class="form-label fs-4"><i class="bi bi-trash3-fill text-danger"></i></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 col-lg-3 border border-success rounded" style="height: 50px;" onclick="addNewCategory();">
                            <div class="row">
                                <div class="col-8 mt-2 mb-2">
                                    <label class="form-label fw-bold fs-5">Add new Category</label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                    <label class="form-label fs-4"><i class="bi bi-plus-square-fill text-success"></i></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--model-->
            <div class="modal fade" id="addNewCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Category </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">New category Name:</label>
                                    <input type="text" class="form-control" id="n" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Enter your email:</label>
                                    <input type="text" class="form-control" id="e" value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveCategory();">Save Category</button>
                        </div>
                    </div>
                </div>
            </div>
            </td>

            <!--model-->



            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="sweetalert.min.js"></script>
    </body>

    </html>



<?php

} else {
    echo ("Please login Again");
}
?>