<?php

session_start();

require "connection.php";


?>




<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="resources\logo.png">
  <title>Tradewave | Home</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="style.css" />

</head>

<body class="bdy">
  <div class="container">
    <div class="row">
      <?php require "header.php"; ?>
      <div class="col-12 justify-content-center">
        <div class="row mb-3">
          <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

          <div class="col-12 col-lg-6">
            <div class="input-group mb-3 mt-3">
              <input type="text" id="basic_search_txt" class="form-control" placeholder="search over tradewave" aria-label="Text input with dropdown button">

              <select class="form-select" id="basic_search_select" style="max-width: 250px;">
                <option value="0">All Categories</option>


                <?php

                $category_rs = Database::search("SELECT * FROM `category`");
                $category_num = $category_rs->num_rows;

                for ($x = 0; $x < $category_num; $x++) {

                  $category_data = $category_rs->fetch_assoc();

                ?>

                  <option value="<?php echo $category_data["cat_id"]; ?>">
                    <?php echo $category_data["cat_name"]; ?></option>

                <?php

                }
                ?>

              </select>
            </div>
          </div>

          <div class="col-12 col-lg-2 d-grid">
            <button class="btn btn-primary mt-3 mb-3" onclick="basicSearch(0);">Search</button>
          </div>

          <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
            <a href="advancedsearch.php" class="text-decoration-none link-secondary fw-bold">Advanced</a>
          </div>

        </div>
      </div>
      <div id="searchresults">
      <div class="row main">
        <div class="col-12 col-lg-6">
          <h1>Get Experience of <br /> New style!</h1><br />
          <p>Welcome to TradeWave! Unlock a world of shopping delights, exclusive <br />offers, and personalized experiences.
            Your shopping journey<br /> begins with a simple and secure Way. Let's get started!</p>
          <button class="btn btn-outline-primary">Explore Now &nbsp;&rarr;</button>
        </div>
        <div class="col-12 col-lg-6 ">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" data-bs-interval="1000">
              <div class="carousel-item active">
                <img src="resources\products\mobile.png" class="d-block w-100">
              </div>
              <div class="carousel-item" data-bs-interval="1000">
                <img src="resources\products\exclusive.png" class="d-block w-100">
              </div>
              <div class="carousel-item" data-bs-interval="1000">
                <img src="resources\products\DJI Mini Drone_1_665eaa9578820.png" class="d-block w-100">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

      </div>
      <!---Products---->
      <div class="row justify-content-center gap-4" style="margin-top: 20px;">
        <h1 class="text-light">New Arrivals &nbsp;&rarr;</h1>

        <?php
        $product_rs = Database::search("SELECT * FROM `product` WHERE `status_status_id`='1' ORDER BY 
                                    `datetime_added` DESC");
        $product_num = $product_rs->num_rows;

        for ($x = 0; $x < $product_num; $x++) {
          $product_data = $product_rs->fetch_assoc();
        ?>

          <div class="card col-12 col-lg-3" style="width: 18rem;">
            <?php
            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");

            $img_data = $img_rs->fetch_assoc();

            $con_rs = Database::search("SELECT  `condition_name` FROM `condition` INNER JOIN `product` ON condition.condition_id=product.condition_condition_id");
            $con_data = $con_rs->fetch_assoc();

            $status_rs = Database::search("SELECT `status_name` FROM `status` INNER JOIN `product` ON status.status_id=product.status_status_id");
            $status_data = $status_rs->fetch_assoc();
            ?>
            <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
              <span class="badge rounded-pill text-bg-info"><?php echo $con_data["condition_name"]; ?></span><br />
              <span class="card-text text-primary">Rs.<?php echo $product_data["price"]; ?></span><br />
              <span class="card-text text-warning fw-bold"><?php echo $status_data["status_name"]; ?></span><br />
              <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br />
              <a href="<?php echo "singleproductview.php?id=". ($product_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a>
              <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                <i class="bi bi-cart4 text text-white fs-5"></i>
              </button>
              <button onclick="addTowatchlist(<?php echo $product_data['id']; ?>);" class="col-12 btn btn-outline-light mt-2 border border-primary">
                <i class="bi bi-heart-fill  text-dark fs-5"></i>
              </button>
            </div>
          </div>
        <?php
        }

        ?>




      </div>
      <!---Products---->
      <div class="row " style="margin-top:30px;">
        <h1>Categories &nbsp;&rarr;</h1>
        <?php

        $c_rs = Database::search("SELECT * FROM `category`");
        $c_num = $c_rs->num_rows;

        for ($y = 0; $y < $c_num; $y++) {

          $c_data = $c_rs->fetch_assoc();

        ?>


          <div class="col-12 col-lg-3">
            <a href="" style="text-decoration: none;">
              <img src="resources\categories.png" class="img">
              <p style="margin-left: 80px;"><?php echo $c_data["cat_name"]; ?></p>
            </a>
          </div>




        <?php
        }
        ?>
      </div>
      </div>
      <?php require "footer.php"; ?>
    </div>
    
  </div>

  <script src="script.js"></script>
  <script src="bootstrap.bundle.js"></script>
  <script src="sweetalert.min.js"></script>
</body>

</html>