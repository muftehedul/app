<?php
// Initialize the session
session_start();
if (isset($_SESSION['id'])) {
$userId=$_SESSION['id'];
}
else{
$userId=0;
}
require_once "additional/dbConnect.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>YourShop</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <style type="text/css">
    html,
    body,
    header,
    .carousel {
    height: 60vh;
    }
    @media (max-width: 740px) {
    html,
    body,
    header,
    .carousel {
    height: 100vh;
    }
    }
    @media (min-width: 800px) and (max-width: 850px) {
    html,
    body,
    header,
    .carousel {
    height: 100vh;
    }
    }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container">
        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index.php">
          <strong class="blue-text">YourShop</strong>
        </a>
        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link waves-effect" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="about.php">About YourShop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="addproduct.php">add new product</a>
            </li>
            
          </ul>
          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="showCart.php" class="nav-link waves-effect">
                <span class="badge red z-depth-1 mr-1">
                  <?php
                  $sql = "SELECT COUNT(user_id) AS count FROM cart WHERE cart.user_id=$userId;";
                  $result = mysqli_query($link, $sql);
                  while($row = mysqli_fetch_assoc($result))
                  {
                  echo $row['count'];
                  }
                  ?>
                </span>
                <i class="fas fa-shopping-cart"></i>
                <span class="clearfix d-none d-sm-inline-block"> Cart </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://www.facebook.com" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://twitter.com" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://github.com" class="nav-link border border-light rounded waves-effect"
                target="_blank">
                <i class="fab fa-github mr-2"></i>GitHub
              </a>
            </li>
            <li class="nav-item">
              <?php
              if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
              echo '<a href="logout.php" class="nav-link border border-light rounded waves-effect">log out</a>';
              }
              else{
              echo'<a href="login.php" class="nav-link border border-light rounded waves-effect">login</a>';
              }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->
    
    <!--Main layout-->
    
    <div>
      <div class="container" style="width:95%;">
        <br/><br/><br>
        <h3 align="center" class="bg-info">Order Details</h3>
        <br />
        <br />
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Firstname</th>
                <th>Last</th>
                <th>address</th>
                <th>postal code</th>
                <th>phone</th>
                <th>Email</th>
                <th>bkashTransactionId</th>
                <th>product ID</th>
                <th>Total Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * from orders";
              $result = mysqli_query($link, $query);
              while($row = mysqli_fetch_array($result))
              {
              echo '
              <tr>
                <td>'.$row["id"] .'</td>
                <td>'.$row["firstName"] .'</td>
                <td>'.$row["lastName"] .'</td>
                <td>'.$row["address"] .'</td>
                <td>'.$row["postalCode"] .'</td>
                <td>'.$row["phone"] .'</td>
                <td>'.$row["email"] .'</td>
                <td>'.$row["bkashTransactionId"] .'</td>
                <td>'.$row["productIds"] .'</td>
                <td>'.$row["totalAmount"] .'</td>
                
              </tr>
              
              ';}
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!--Main layout-->
      <!--Footer-->
      <footer class="page-footer text-center font-small mt-4 wow fadeIn">
        <!--Call to action-->
        <div class="pt-4">
          <a class="btn btn-outline-white" href="#" role="button">Home
            <i class="fas fa-shopping-cart ml-2"></i>
          </a>
          <a class="btn btn-outline-white" href="about.php" role="button">About Us
            <i class="fab fa-dribbble ml-2"></i>
          </a>
        </div>
        <!--/.Call to action-->
        <hr class="my-4">
        <!-- Social icons -->
        <div class="pb-4">
          <a href="#" target="_blank">
            <i class="fab fa-facebook-f mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-twitter mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-youtube mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-google-plus-g mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-dribbble mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-pinterest mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-github mr-3"></i>
          </a>
          <a href="#" target="_blank">
            <i class="fab fa-codepen mr-3"></i>
          </a>
        </div>
        <!-- Social icons -->
        <!--Copyright-->
        <div class="footer-copyright py-3">
          © 2021 Copyright:
          <a href="#" target="_blank"> Muftehedul Islam Mithul </a>
        </div>
        <!--/.Copyright-->
      </footer>
      <!--/.Footer-->
      <!-- SCRIPTS -->
      <!-- JQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="js/mdb.min.js"></script>
      <!-- Initializations -->
      <script type="text/javascript">
      // Animations initialization
      new WOW().init();
      </script>
    </body>
  </html>