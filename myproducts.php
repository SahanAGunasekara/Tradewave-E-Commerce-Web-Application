<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    $pageno;


?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Products | Tradewave</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources\logo.png" />

    </head>

    <body class="bdy">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 bg-primary">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1 text-center">

                                    <?php

                                    $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

                                    if ($profile_img_rs->num_rows == 1) {

                                        $profile_img_data = $profile_img_rs->fetch_assoc();

                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" width="90px" height="90px" class="rounded-circle" />
                                    <?php

                                    } else {
                                    ?>
                                        <img src="resourses\user profile.svg" width="90px" height="90px" class="rounded-circle" />
                                    <?php
                                    }

                                    ?>



                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row text-center text-lg-start">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="text-white fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-5 mt-2 my-lg-4 d-grid">
                                    <form class="d-flex" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="s">
                                        <button class="btn btn-outline-danger" type="submit">Search</button>
                                    </form>
                                </div>
                                <div class="col-12 col-lg-7 mx-2 mb-2 mt-2 my-lg-4 mx-lg-0 d-grid ">
                                    <button class="btn btn-warning fw-bold" onclick="window.location='addProduct.php'">Add Product</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-10 rounded" style="background-color: white;">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-4 ">
                        <h1>My sellings</h1>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-6">
                        <h2>Active Time</h2>
                        <div class="col-12">
                            <hr style="width: 80%;" />
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="n">
                                <label class="form-check-label" for="n">
                                    Newest to oldest
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="o">
                                <label class="form-check-label" for="o">
                                    Oldest to newest
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6">
                        <h2>By Quatity</h2>
                        <div class="col-12">
                            <hr style="width: 80%;" />
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="h">
                                <label class="form-check-label" for="n">
                                    High to Low
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="l">
                                <label class="form-check-label" for="o">
                                    Low to High
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-6">
                        <h2>By Condition</h2>
                        <div class="col-12">
                            <hr style="width: 80%;" />
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r3" id="b">
                                <label class="form-check-label" for="n">
                                    Brand New
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r3" id="u">
                                <label class="form-check-label" for="o">
                                    Used
                                </label>
                            </div>
                        </div>

                    </div>



                </div>
                <div class="row mt-4 mb-3">
                    <div class="col-12 col-lg-6 d-grid mb-1">
                        <button class="btn btn-dark" onclick="sort(0);">Sort</button>
                    </div>
                    <div class="col-12 col-lg-6 d-grid mb-1">
                        <button class="btn btn-success" onclick="clearSort();">Clear</button>
                    </div>

                </div>

            </div>

        </div>

        <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3 mt-4">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="sort">
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


        <?php include "footer.php"; ?>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>


<?php
} else {
?>

<?php

}
