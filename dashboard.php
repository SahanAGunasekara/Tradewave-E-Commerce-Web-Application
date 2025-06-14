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
        <title>Tradewave | Admin Dashboard</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>
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
                                            <span class="text-white fw-bold"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8 text-center mt-4">
                            <h1>Dashboard Analysis</h1>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-2" style="height: 400px; background-color:ash;">
                    <div class="">
                        <div class="row">
                            <div class="col-12 align-items-start bg-dark">
                                <div class="row g-1 text-center">


                                    <div class="col-12 mt-4">

                                        <h4 class="text-white fw-bold text-start"> <i class="bi bi-speedometer2" style="color: red;"></i> Dashboard</h4>

                                    </div>
                                    <div class="nav flex-column nav-pills me-3 mt-3 text-start" role="tablist" aria-orientation="vertical">
                                        <nav class="nav flex-column">

                                            <a class="nav-link" href="manageUsers.php"> <i class="bi bi-people"></i> Manage Users</a>
                                            <a class="nav-link" href="manageProducts.php"> <i class="bi bi-diagram-3"></i> Manage Products</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-receipt-cutoff"></i> Sales</a>
                                        </nav>
                                    </div>
                                    <div class="col-12 mt-1">

                                        <h4 class="text-white fw-bold text-start"> <i class="bi bi-app-indicator" style="color: red;"></i> Apps</h4>

                                    </div>
                                    <div class="nav flex-column nav-pills me-3 mt-3 text-start" role="tablist" aria-orientation="vertical">
                                        <nav class="nav flex-column">
                                            <a class="nav-link " aria-current="page" href="#"> <i class="bi bi-tablet-landscape"></i> Landings</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-list-task"></i> Tasks</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-prescription"></i> CRM</a>

                                        </nav>
                                    </div>
                                    <div class="col-12 mt-1">

                                        <h4 class="text-white fw-bold text-start"> <i class="bi bi-gear" style="color: red;"></i> Settings</h4>

                                    </div>
                                    <div class="nav flex-column nav-pills me-3 mt-3 text-start" role="tablist" aria-orientation="vertical">
                                        <nav class="nav flex-column">
                                            <a class="nav-link " aria-current="page" href="#"> <i class="bi bi-table"></i> Tables</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-journal-x"></i> Elements</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-map-fill"></i> Map</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-gear"></i> Settings</a>
                                            <a class="nav-link" href="#"> <i class="bi bi-menu-button-wide-fill"></i> Widgets</a>
                                        </nav>
                                    </div>
                                    <div class="col-12 mt-1">

                                        <h4 class="text-white fw-bold text-start"> <i class="bi bi-clock-history" style="color: red;"></i> Selling History</h4>

                                    </div>
                                    <div class="nav flex-column nav-pills me-3 mt-3 text-start mb-3" role="tablist" aria-orientation="vertical">
                                        <nav class="nav flex-column">
                                            <a class="nav-link " aria-current="page" href="#"> <i class="bi bi-calendar-check"></i> From Date</a>
                                            <input type="date" class="form-control" />
                                            <a class="nav-link" href="#"> <i class="bi bi-calendar-check"></i> To Date</a>
                                            <input type="date" class="form-control" />
                                            </hr style="color:white;">
                                            <a href="#" class="btn btn-primary mt-2">Search</a>

                                        </nav>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10 bg-light">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="card text-bg-danger mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-6 col-lg-6">
                                            <p>
                                            <h2>914,000</h2>
                                            </p>
                                            <p>
                                            <h2>visits</h2>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-6">
                                            <img src="resources\couple.png" style="height: 90px;" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card text-bg-warning mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-6 col-lg-6">
                                            <p>
                                            <h2>46.41 %</h2>
                                            </p><br />
                                            <p>
                                            <h6>BOUNCE RATE</h6>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-6">
                                            <img src="resources\redo-arrow.png" style="height: 90px;" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card text-bg-success mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-6 col-lg-6">
                                            <p>
                                            <h3>4,056,876</h3>
                                            </p><br />
                                            <p>
                                            <h6>PAGEVIEWS</h6>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-6">
                                            <img src="resources\document.png" style="height: 90px;" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card text-bg-info mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-6 col-lg-6">
                                            <p>
                                            <h3> 46.43 % </h3>
                                            </p><br />
                                            <p>
                                            <h6>GROWTH RATE</h6>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-6">
                                            <img src="resources\bar-graph.png" style="height: 90px;" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="card text-bg-light mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <img src="resources\user statictics.jpg" style="height: 330px;" />

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card text-bg-light mb-3 mt-3">

                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <img src="resources\user interaction.jpg" style="height: 150px;" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card text-bg-light mb-3 mt-3">

                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <img src="resources\browser stat.jpg" style="height: 136px;" />

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card text-bg-light mb-3 mt-3">

                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                <img src="resources\traffic.jpg" style="height: 330px;" />

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-12">
                        <h2>Sale Ends In</h2>

                    </div>
                    <div class="row  p-3 mt-2">

                        <div class="col-3 col-lg-3">
                            <div class="card text-bg-primary mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <p style="font-size: 50px;" id="days">00</p>
                                        <span style="font-size: 20px;">Days</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3">
                            <div class="card text-bg-primary mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <p style="font-size: 50px;" id="hours">00</p>
                                        <span style="font-size: 20px;">Hours</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3">
                            <div class="card text-bg-primary mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <p style="font-size: 50px;" id="minutes">00</p>
                                        <span style="font-size: 20px;">Minutes</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3">
                            <div class="card text-bg-primary mb-3 mt-3">

                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <p style="font-size: 50px;" id="seconds">00</p>
                                        <span style="font-size: 20px;">Seconds</span>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <script>
            var countDownDate = new Date("Oct 16, 2025 00:00:00").getTime();
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("days").innerHTML = days;
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("days").innerHTML = days;
                    document.getElementById("hours").innerHTML = hours;
                    document.getElementById("minutes").innerHTML = minutes;
                    document.getElementById("seconds").innerHTML = seconds;
                }
            }, 1000);
        </script>
        <script src="sweetalert.min.js"></script>
    </body>

    </html>

<?php

} else {
?>
    You does not have access for login
<?php
}

?>