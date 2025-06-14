<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Messages | eShop</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources\logo.png" />
    </head>

    <body>
        <?php require "header.php"; ?>
        <div class="container-fluid">

            <div class="row justify-content-center mt-4 mb-4">
                <div class="col-12 col-lg-6 bg-light" style="border-radius: 8px;">
                    <h4>Recents</h4>
                    <ul class="nav nav-tabs">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" onclick="ChangeView1();">Recieved</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#" onclick="ChangeView1();">Send</a>
                        </li>

                    </ul>

                    <?php

                    $msg_rs = Database::search("SELECT DISTINCT `content`,`date_time`,`status`,`from` 
                    FROM `chat` WHERE `to`='" . $mail . "' ORDER BY `date_time` DESC");
                    $msg_num = $msg_rs->num_rows;

                    ?>

                    <!--Recieved-->
                    <div class="col-12 col-lg-6 bg-light" style="height: 400px; width:auto" id="recievedbox">
                        <?php

                        for ($x = 0; $x < $msg_num; $x++) {
                            $msg_data = $msg_rs->fetch_assoc();

                            if ($msg_data["status"] == 0) {

                        ?>
                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                    <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">
                                        <?php

                                        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $msg_data["from"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        ?>
                                        <div class="media">
                                            <?php

                                            if (isset($img_data["path"])) {
                                            ?>
                                                <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="resources\Profile_images\user.png" width="50px" class="rounded-circle">
                                            <?php
                                            }

                                            ?>

                                            <div class="me-4">
                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                    <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"]; ?></h6>
                                                    <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                </div>
                                                <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            <?php

                            } else {
                            ?>
                                <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                    <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 bg-body">
                                        <?php

                                        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $msg_data["from"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        ?>
                                        <div class="media">
                                            <?php

                                            if (isset($img_data["path"])) {
                                            ?>
                                                <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="resources\Profile_images\user.png" width="50px" class="rounded-circle">
                                            <?php
                                            }

                                            ?>

                                            <div class="me-4">
                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                    <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"]; ?></h6>
                                                    <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                </div>
                                                <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                        <?php
                            }
                        }

                        ?>

                    </div>
                    <!--Recieved-->
                    <!--sent-->
                    <div class="col-12 col-lg-6 d-none bg-light" style="height: 400px; width:auto" id="sentbox">
                        <?php

                        $msg_rs2 = Database::search("SELECT DISTINCT `content`,`date_time`,`status`,`to` 
                        FROM `chat` WHERE `from`='" . $mail . "' ORDER BY `date_time` DESC");
                        $msg_num2 = $msg_rs2->num_rows;

                        for ($y = 0; $y < $msg_num2; $y++) {
                            $msg_data2 = $msg_rs2->fetch_assoc();
                        ?>
                            <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                <a href="#" class="list-group-item list-group-item-action text-black rounded-0 bg-secondary">
                                    <div class="media">
                                        <?php

                                        $user_rs2 = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data2["to"] . "'");
                                        $user_data2 = $user_rs2->fetch_assoc();

                                        $img_rs2 = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $msg_data2["to"] . "'");
                                        $img_data2 = $img_rs2->fetch_assoc();

                                        if (isset($img_data2["path"])) {
                                        ?>
                                            <img src="<?php echo $img_data2["path"]; ?>" width="50px" class="rounded-circle">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources\Profile_images\user.png" width="50px" class="rounded-circle">
                                        <?php
                                        }

                                        ?>
                                        <div class="me-4">
                                            <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                <h6 class="mb-0 fw-bold"> me</h6>
                                                <small class="small fw-bold"><?php echo $msg_data2["date_time"]; ?></small>

                                            </div>
                                            <p class="mb-0"><?php echo $msg_data2["content"]; ?></p>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        <?php
                        }

                        ?>

                    </div>
                    <!--sent-->
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
?>
    <p>You Are an evil</p>
<?php
}

?>