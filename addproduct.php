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
        <title>Tradewave | add product</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="bdy">
        <?php
        require "header.php";
        ?>

        <div class="container fluid text-light">
            <div class=" justify-content-center col-12 col-lg-12">

                <h1 class="text-center text-light">Complete Your listing</h1>

                <p>PHOTOS & VEDIOS </p>
                <div class="offset-lg-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-4 border border-primary rounded">
                            <img src="resources\addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                        </div>
                        <div class="col-4 border border-primary rounded">
                            <img src="resources\addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                        </div>
                        <div class="col-4 border border-primary rounded">
                            <img src="resources\addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                        </div>
                    </div>
                </div>
                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                    <input type="file" class="d-none" id="imageuploader" multiple />
                    <label for="imageuploader" class="col-12 btn btn-outline-primary" onclick="changeProductImage();">Upload Images</label>
                </div>

                <h3>Title</h3>

                <labelp class="form-label" for="firstname">Item title</label>
                    <input class="form-control" type="text" id="title" placeholder="title">
                    <p>
                    <h3>ITEM CATEGORY </h3>
                    </p>
                    <div class="col-12 col-lg-6">
                        <select class="form-select" id="category" onchange="loadBrands();">
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
                    <br>
                    <p>
                    <h3>ITEM SPECIFICS</h3>
                    </p>
                    <br>
                    <p>
                    <h4>Required</h4>
                    </p>
                    <p>Buyers need these details to find your item</p>
                    <form>

                        <div class="row mb-3">
                            <label for="Form-element" class="col-sm-2 col-form-label">Brand</label>
                            <div class="col-sm-10">
                                <div class="col-md-4">

                                    <select class="form-select" id="brand" onchange="loadModel();">
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
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Form-element" class="col-sm-2 col-form-label">Model</label>
                            <div class="col-sm-10">
                                <div class="col-md-4">

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
                            </div>
                        </div>
                        <br>
                        <p>
                        <h4>Additional (Optional)</h4>
                        </p>
                        <p>Buyers also serach for these details</p>
                        <div class="row mb-3">
                            <label for="Form-element" class="col-sm-2 col-form-label">UPC</label>
                            <div class="col-sm-10">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Enter Number">
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label for="Form-element" class="col-sm-2 col-form-label">Type - 32.5k searches</label>
                                <div class="col-sm-10">
                                    <div class="col-md-4">

                                        <select class="form-select">
                                            <option selected>Choose your brand</option>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label for="Form-element" class="col-sm-2 col-form-label">Form - 28.5k searches</label>
                                <div class="col-sm-10">
                                    <div class="col-md-4">

                                        <select class="form-select">
                                            <option selected>Choose your brand</option>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            

                           

                            

                          


                                <div class="row mb-3 mt-3">
                                    <label for="Form-element" class="col-sm-2 col-form-label">MPN</label>
                                    <div class="col-sm-10">
                                        <div class="col-md-4">

                                            <select class="form-select">
                                                <option selected></option>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                             


                               


                                <div class="row mb-3 mt-3">
                                    <label for="Form-element" class="col-sm-2 col-form-label">Labels & Certifications</label>
                                    <div class="col-sm-10">
                                        <div class="col-md-4">

                                            <select class="form-select">
                                                <option selected></option>
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-3 mt-3">
                                    <label for="Form-element" class="col-sm-2 col-form-label">Item Weight</label>
                                    <div class="col-sm-10">
                                        <div class="col-md-4">

                                            <select class="form-select">
                                                <option selected></option>
                                                <option></option>
                                            </select>
                                            Frequently Selected: 100g,250g,500g
                                        </div>
                                    </div>
                                </div>

                                

                                    <div class="row mb-3 mt-3">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Color</label>
                                        <div class="col-sm-10">
                                            <div class="col-md-4">
                                                <select class="form-select" id="color">
                                                    <option value="0">Select Colour</option>
                                                    <?php

                                                    $clr_rs = Database::search("SELECT * FROM `color`");
                                                    $clr_num = $clr_rs->num_rows;

                                                    for ($x = 0; $x < $clr_num; $x++) {
                                                        $clr_data = $clr_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo $clr_data["color_id"]; ?>"><?php echo $clr_data["color_name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                                <div class="col-12">
                                                    <div class="input-group mt-2 mb-2">
                                                        <input type="text" class="form-control" placeholder="Add new Colour" id="clr" />
                                                        <button class="btn btn-outline-success" type="button" onclick="updateclr();">+ Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                   
                    </form>
                    <p>
                    <h4>CONDITION</h4>
                    <div class="form-check col-12 col-lg-6">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="b">
                        <label class="form-check-label" for="b">
                            Brand New
                        </label>
                    </div>
                    <div class="form-check col-12 col-lg-6">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="u" checked>
                        <label class="form-check-label" for="u">
                            used
                        </label>
                    </div>
                    <br>
                    <p>
                    <h4>DESCRIPTION</h4>
                    </p>
                    <p>Provide a description for your item.Tell buyers about unique features and/or why you are selling it.</p>
                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                    </div>
                    <div class="col-12">
                        <textarea cols="30" rows="15" class="form-control" id="desc"></textarea>
                    </div>
            </div>
            <p>
            <h4>Pricing</h4>
            </p>
            <div class="row">
                <div class="col-6">
                    <label class="form-label" for="firstname">Format</label>
                    <select class="form-select">
                        <option selected></option>
                        <option></option>
                    </select>
                    <label class="form-label" for="price">Price</label>
                    <input class="form-control" type="number" placeholder="Rs." id="cost">
                    <label class="form-label" for="qty">Quantity</label>
                    <input class="form-control" type="number" placeholder="" id="qty">
                </div>

            </div>

            <div class="row">
                <div class="col-6">
                    <p>
                    <h4>Allow offers</h4>
                    </p>
                    Buyers interested in your item can make you offers - you can accept,counter or decline
                    <p>
                    <h4>Add volume pricing</h4>
                    </p>
                    Offer a discount when buyers purchase more than one item at once
                    <br><br><br>
                    <p>Buyers are more likely to purchase more of the same item if you add avolume pricing discount</p>
                    <p>
                    <h4>Schedule your listing</h4>
                    </p>
                    Your listing goes live immediately,unless you select atime and date you want it to start.
                    <br><br><br>
                    <p>Use sales tax table to manage the tax rate for jurisdictions where you may have an obligations to collect tax from buyers.</p>
                </div>
                <div class="col-6">
                    <div class="form-check form-switch form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckRevrse">
                    </div>
                    <br><br><br>
                    <div class="form-check form-switch form-check ">
                        <input class="form-check-input" type="checkbox" id="flexSwitchheckReverse">
                    </div>
                    <br><br><br><br><br><br>
                    <div class="form-check form-switch form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="flexwitchCheckReverse">
                    </div>

                </div>

            </div>
            <p>
            <h4>SHIPPING</h4>
            </p>


            <div class="row mb-3 mt-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Shipping method</label>
                <div class="col-sm-10">
                    <div class="col-md-4">

                        <select class="form-select">
                            <option selected>Standard shipping</option>
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-2">
                    <label for="inputZip" class="form-label"> weight</label>
                    <input type="number" class="form-control" placeholder="Kg">
                </div>

                <div class="col-md-2">
                    <label for="inputZip" class="form-label">(Optional)</label>
                    <input type="number" class="form-control" placeholder="g">
                </div>


                <div class="col-md-2">
                    <label for="inputZip" class="form-label"> Package</label>
                    <input type="number" class="form-control" placeholder="Kg">
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label"> dimensions</label>
                    <input type="number" class="form-control" placeholder="Kg">
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label"> (Optional)</label>
                    <input type="number" class="form-control" placeholder="Kg">
                </div>


            </div>

            <p>
            <h3>International shipping</h3>
            </p>
            <p>
            <h4>Add shipping service</h4>
            </p>
            <div class="col-md-4">
                <label for="inputZip" class="form-label"> Cost type</label>
                <div class="col-md-12">

                    <select class="form-select">
                        <option selected>Flat rate: Same cost regardless of buyer ......</option>
                        <option></option>
                    </select>
                </div>
            </div>
            <br><br><br>
            <label for="inputZip" class="form-label"> International Services</label>
            <div class="col-6">
                <div class="card">
                    <div class="card-header" style="color:grey;">
                        Economy international Shipping
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text" style="color:grey;">13 - 23 Business days</p>
                        <label class="form-label col-5" for="firstname" style="color:grey;">Ship locally</label>
                        <input class="form-control" type="number" placeholder="Rs." id="dfi">
                        <b style="color:grey;">Ship Worldwide</b>
                        <input class="form-control" type="number" placeholder="Rs." id="dwc">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="inputZip" class="form-label"> Rate table</label>
                <div class="col-md-12">

                    <select class="form-select">
                        <option selected>None</option>
                        <option></option>
                    </select>
                </div>
            </div>
            <br>
            <p>
                <br />
            <div>
                <div class="col-12 col-lg-6">
                    <p>
                    <h5>Domestic return</h5>
                    </p>
                    Accept within 30 days
                    Buyer pays return shipping
                    Money back or replacement
                </div>
                <br />
                <div class="col-12 col-lg-6">
                    <p>
                    <h5>International returns</h5>
                    </p>
                    Accept within 30 days
                    Buyer pays return shipping
                    Money back or replacement
                </div>
            </div>
            <br />



            <h3>PREFERENCES</h3>


            <h4>Payment</h4>

            <u>Payment managed by e-Tech</u>
            <br>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Required immediate payment when buyer uses Buy it Now
                    </label>
                </div>
            </div>
            <br><br>
            <div class="col-12 d-none" id="msgdiv1">
                <div class="alert alert-warning" role="alert" id="msg1">

                </div>
            </div>
            <p class="text-center" style="font-size: 30px;">List it for free</p>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary mt-2" style="border-radius: 20px;" type="button" onclick="addProduct();">List it</button>
                <button class="btn btn-outline-secondary mt-2" style="border-radius: 20px;" type="button">Save for later</button>
                <button class="btn btn-outline-secondary mt-2" style="border-radius: 20px;" type="button">Preview</button>
            </div>

           
        </div>

        <?php
        require "footer.php";
        ?>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>

    </html>
<?php
} else {
}


?>