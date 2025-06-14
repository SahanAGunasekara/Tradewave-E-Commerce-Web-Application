<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources\logo.png">
    <title>Tradewave | UserProfile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <?php

    session_start();

    require "header.php";

    require "connection.php";

    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

        $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON  
                                    users.gender_id=gender.id WHERE `email`='" . $email . "'");

        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON  
                                    user_has_address.city_city_id=city.city_id INNER JOIN 
                                    `district` ON city.district_district_id=district.district_id 
                                    INNER JOIN `province` ON 
                                    district.province_province_id=province.province_id 
                                    WHERE `users_email`='" . $email . "'");

        $details_data = $details_rs->fetch_assoc();
        $image_data = $image_rs->fetch_assoc();
        $address_data = $address_rs->fetch_assoc();

    ?>
        <div class="container light-style flex-grow-1 container-p-y">
            <div class="card overflow-hidden mt-3">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>

                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class=" row card-body media align-items-center">
                                    <div>
                                        <?php
                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resources\Profile_images\user.png" alt class="d-block ui-w-80 ">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" alt class="d-block ui-w-80 rounded-circle">
                                        <?php
                                        }



                                        ?>

                                    </div>
                                    <div class="media-body ">
                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-primary mt-5">Update Profile Image</label>

                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1"  value="<?php echo $details_data["fname"] . " " . $details_data["lname"]; ?>">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 col-lg-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" id = "fname" value="<?php echo $details_data["fname"];?>">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label class="form-label">last Name</label>
                                            <input type="text" class="form-control" id = "lname" value="<?php echo $details_data["lname"]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="form-label">Gender</label>
                                        <input type="text" class="form-control mb-1" readonly value="<?php echo $details_data["gender_name"]; ?>">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" id = "email" value="<?php echo $details_data["email"]; ?>">

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="col-12">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="Upp" value="<?php echo $details_data["password"]; ?>" class="form-control" aria-describedby="pwb">
                                            <span class="input-group-text" id="Uppb" onclick="showPassword3();"><i class="bi bi-eye-fill"></i></span>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="tab-pane fade" id="account-info">
                                <div class="card-body pb-2">

                                    <div class="form-group">
                                        <label class="form-label">Registerd Date</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"]; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" value="<?php if (!empty($address_data["line1"])) {
                                            echo $address_data["line1"];
                                        }?>"     id="line1">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control" value="<?php if (!empty($address_data["line2"])) {
                                            echo $address_data["line2"];
                                        }?>"    id="line2">
                                    </div>
                                    <div class="row">
                                        <?php
                                        $province_rs = Database::search("SELECT * from `province`");
                                        $district_rs = Database::search("SELECT * from `district`");
                                        $city_rs = Database::search("SELECT * from `city`");

                                        $province_num = $province_rs->num_rows;
                                        $district_num = $district_rs->num_rows;
                                        $city_num = $city_rs->num_rows;

                                        ?>
                                        <div class="form-group col-12 col-lg-6">
                                            <label  class="form-label">Province</label>
                                            <select  class="form-select" id= "province">
                                                <option value="0">Select Province</option>
                                                <?php

                                                for ($x = 0; $x < $province_num; $x++) {
                                                    $province_data = $province_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                    if (!empty($address_data["province_province_id"])) {
                                                                                                                        if ($province_data["province_id"] == $address_data["province_province_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>>
                                                        <?php echo $province_data["province_name"]; ?>
                                                    </option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label  class="form-label">District</label>
                                            <select  class="form-select" id= "district">
                                                <option value="0">Select District</option>
                                                <?php

                                                for ($x = 0; $x < $district_num; $x++) {
                                                    $district_data = $district_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                                    if (!empty($address_data["district_district_id"])) {
                                                                                                                        if ($district_data["district_id"] == $address_data["district_district_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                                        ?>>
                                                        <?php echo $district_data["district_name"]; ?>
                                                    </option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 col-lg-6">
                                            <label  class="form-label">City</label>
                                            <select class="form-select" id= "city">
                                                <option value="0">Select City</option>
                                                <?php

                                                for ($x = 0; $x < $city_num; $x++) {
                                                    $city_data = $city_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                            if (!empty($address_data["city_city_id"])) {
                                                                                                                if ($city_data["city_id"] == $address_data["city_city_id"]) {
                                                                                                            ?> selected <?php
                                                                                                                            }
                                                                                                                        }
                                                                                                                                ?>>
                                                        <?php echo $city_data["city_name"]; ?>
                                                    </option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label class="form-label">postal code</label>
                                            <input type="text" class="form-control" value="<?php if (!empty($address_data["postal_code"])) {
                                            echo $address_data["postal_code"];
                                        }?>"   id="pc">
                                        </div>
                                    </div>

                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Contacts</h6>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" id= "mobile" value="<?php echo $details_data["mobile"]; ?>">
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mt-3">
                <button type="button" class="btn btn-primary" onclick="updateProfile();">Save changes</button>&nbsp;
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>

        <script src="jquery-1.10.2.min.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>









    <?php
    }
    ?>
</body>

</html>