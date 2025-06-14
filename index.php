<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Tradewave | Sign In</title>

  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="resources\logo.png">

</head>

<body class="ind">
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: green ;">
          <h2>TradeWave</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#" onclick="ChangeView();">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Contact Us</a>
            </li>


            <li class="nav-item">
              <a class="nav-link active" aria-disabled="true">Rate Us</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <!--signin box-->
    <div class="row">
      <div class="col-sm-12 col-md-6 offset-md-3">
        <div class="sign-in-container d-none" id="SignInBox">
          <h2>Sign In</h2>
          <form>
            <?php
            $email = "";
            $password = "";

            if (isset($_COOKIE["email"])) {
              $email = $_COOKIE["email"];
            }

            if (isset($_COOKIE["password"])) {
              $password = $_COOKIE["password"];
            }
            ?>
            
            <div class="col-12 d-none" id="msgdiv2">
            <div class="alert alert-danger" role="alert" id="msg2">

            </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email1" value="<?php echo $email; ?>" placeholder="Enter your email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password1" value="<?php echo $password; ?>" placeholder="Enter your password">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe" style="color: white;">Remember me</label>
            </div>
            <div class="d-grid">
              <label type="submit" class="btn btn-primary btn-block" onclick="signin();">Sign In</label>
            </div>
          </form>
          <div class="text-center mt-3">
            <p class="text-primary">Don't have an account? <a href="#" onclick="ChangeView();">Sign Up</a></p>
            <p><a href="#" onclick="forgotPassword();">Forgot Password?</a></p>
          </div>
        </div>
      </div>
    </div>
    <!--signin box-->

    <!--signup box-->
    <div class="row">
      <div class="col-sm-12 col-md-6 offset-md-3">
        <div class="sign-up-container" id="SignUpBox">
          <div class="col-12">
            <b>
              <h2>Create New Account</h2>
            </b>
          </div>
          </br>
          <div class="col-12 d-none" id="msgdiv">
            <div class="alert alert-danger" role="alert" id="msg">

            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <label class="form-label">First Name</label>
              <input class="form-control" type="text" placeholder="ex:Jhon" id="fname" />
            </div>
            <div class="col-12 col-lg-6">
              <label class="form-label">Last Name</label>
              <input class="form-control" type="text" placeholder="ex:Dohn" id="lname" />

            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <label class="form-label">Email</label>
              <input class="form-control" type="email" placeholder="ex:Jhon@gmail.com" id="email" />
            </div>

            <div class="col-12 col-lg-6">
              <label class="form-label">Password</label>
              <input class="form-control" type="password" placeholder="ex:12345" id="password" />

            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <label class="form-label">Mobile</label>
              <input class="form-control" type="text" placeholder="0723456296" id="mobile" />
            </div>
            <div class="col-12 col-lg-6">
              <label class="form-label">Gender</label>
              <select class="form-control" id="gender">
                <option value="0">Select your Gender</option>
                <?php
                require "connection.php";

                $rs = Database::search("SELECT * FROM `gender`");
                $n = $rs->num_rows;

                for ($x = 0; $x < $n; $x++) {
                  $d = $rs->fetch_assoc();

                ?>

                  <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                <?php

                }

                ?>
              </select>
            </div>
          </div></br>
          <div class="row" style="padding-bottom: 15px;">
            <div class="col-12 col-lg-6 d-grid" style="margin-bottom: 20px;">
              <button class="btn btn-primary" onclick="signUp();"> Sign Up</button>
            </div>
            <div class="col-12 col-lg-6 d-grid" style="margin-bottom: 20px;">
              <button class="btn btn-success" onclick="ChangeView();">
                Already have an Account? Sign In</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--signup box-->

    <!-- modal -->
    <div class="modal" tabindex="-1" id="forgotPasswordModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Forgot Password?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">

              <div class="col-6">
                <label class="form-label">New Password</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="Upp" />
                  <button class="btn btn-outline-secondary" type="button" id="Uppb" onclick="showPassword3();">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>

              <div class="col-6">
                <label class="form-label">Retype New Password</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="rnp" />
                  <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>

              <div class="col-12">
                <label class="form-label">Verifiction Code</label>
                <input type="text" class="form-control" id="vc" />
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->


    <!--footer-->
    <div class="col-12 d-none d-lg-block fixed-bottom">
      <p class="text-center">&copy;2023 Tradewave.lk || ALL Rights Reserved</p>
    </div>
    <!--footer-->


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="sweetalert.min.js"></script>
</body>

</html>