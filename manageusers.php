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
        <title>Tradewave | Admin | Manage Users</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="">
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
                                            <span class="text-white fw-bold"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 text-center mt-4">
                            <h1>Manage Users</h1>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-5">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search Users" id="t">
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
                                <th scope="col" class="text-center">Profile Image</th>
                                <th scope="col" class="text-center">User Name</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Mobile</th>
                                <th scope="col" class="text-center">Registerd Date</th>
                                <th scope="col" class="text-center">###</th>
                                <th scope="col" class="text-center">Send msg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_rs = Database::search("SELECT * FROM `users`");
                            $user_num = $user_rs->num_rows;


                            for ($x = 0; $x < $user_num; $x++) {
                                $user_data = $user_rs->fetch_assoc();
                            ?>
                                <tr>

                                    <th scope="row" class="text-center"><?php echo $x + 1; ?></th>
                                    <td class="text-center">
                                        <?php
                                        $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $user_data["email"] . "'");


                                        if ($img_rs->num_rows == 1) {

                                            $img_data = $img_rs->fetch_assoc();

                                        ?>
                                            <img src="<?php echo $img_data["path"]; ?>" width="40px" height="40px" class="rounded-circle" />
                                        <?php

                                        } else {
                                        ?>
                                            <img src="resources\Profile_images\user.png" width="40px" height="40px" class="rounded-circle" />
                                        <?php
                                        }

                                        ?>
                                    </td>
                                 
                                    <td class=""><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
                                    <td class=""><?php echo $user_data["email"]; ?></td>
                                    <td class="text-center"><?php echo $user_data["mobile"]; ?></td>
                                    <td class="text-center"><?php echo $user_data["joined_date"]; ?></td>
                                    <td class="text-center">
                                        <?php

                                        if ($user_data["status"] == 1) {
                                        ?>
                                            <button  class="btn btn-danger" onclick="blockUser('<?php echo $user_data['email']; ?>');">Block</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-success" onclick="blockUser('<?php echo $user_data['email']; ?>');">Unblock</button>
                                        <?php

                                        }

                                        ?>
                                    </td>
                                    <td class="text-center" >
                                    <img src="resources\email.png" width="40px" height="40px"  onclick="contactUser('<?php echo $user_data['email']; ?>');"/>
                                    <!--model-->
                                    <div class="modal fade" id="contactUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Message </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>


                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                            <input type="text" class="form-control" id="recipient-name" value="<?php echo $user_data["email"]; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Message:</label>
                                                            <textarea class="form-control" id="msgtxt"></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Send message</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
            <button class="btn btn-danger mt-2 mb-2"><i class=" bi-printer-fill" onclick="printinvoice();"> Get Report</i></button>
                    

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