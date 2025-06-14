

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="style.css" />

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary background">
    <div class="container-fluid">


      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        
        if (isset($_SESSION['u'])) {
          $session_data = $_SESSION["u"];
        ?>
          <a class="navbar-brand mt-2"  href="#">Hi,<?php echo $session_data["fname"] . " " . $session_data["lname"]; ?> </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <li class="navbar-brand">
              <a class="nav-link active" aria-current="page" href="#" onclick="signout();">Sign Out</a>
            </li>
          <?php
        } else {
          ?>
            <li class="navbar-brand">
              <a class="nav-link active" aria-current="page" href="index.php">Sign in Or Register</a>
            </li>
          <?php
        }

          ?>

          <li class="navbar-brand">
            <a class="nav-link" href="#"><b>Help And Contact</b></a>
          </li>
          <li class="navbar-brand dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tradewave
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
              <li><a class="dropdown-item" href="addproduct.php">Add new product</a></li>

              <li><a class="dropdown-item" href="myproducts.php">My Products</a></li>
              <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
              <li><a class="dropdown-item" href="purchasehistory.php">purchased History</a></li>
              <li><a class="dropdown-item" href="messages.php">Messages</a></li>
              <li><a class="dropdown-item" href="#">My Sellings</a></li>
              <li><a class="dropdown-item" href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">Contact Admin</a></li>
            </ul>
          </li>

      </ul>
      <form class="d-flex" role="search">
        <a class="navbar-brand" href="cart.php"><i class="bi bi-bag-check"></i></a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="navbar-brand" href="#">SELL</a>
            </li>

          </ul>
      </form>
    </div>
    </div>
  </nav>
  
  <!--model-->
  <div class="modal fade" id="contactAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Send Message to Admin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        <?php
        if(isset($_SESSION["u"])){
          $session_data = $_SESSION["u"];
        }
        ?>
        
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" value="sahan5akalanka2003@gmail.com">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="msgtxt"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  onclick="sendAdminMsg('kamal@gmaill.com');">Send message</button>
      </div>
    </div>
  </div>
</div>

  <!--model-->


</body>

</html>