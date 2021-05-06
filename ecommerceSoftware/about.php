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
    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
      </ol>
      <!--/.Indicators-->
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <!--First slide-->
        <div class="carousel-item active">
          <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg'); background-repeat: no-repeat; background-size: cover;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">
              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                <strong>Shoping for happy persion</strong>
                </h1>
                <p>
                  <strong>Best & comfortable online market place</strong>
                </p>
                <p class="mb-4 d-none d-md-block">
                  <strong>.</strong>
                </p>
                <a href="#" class="btn btn-outline-white btn-lg">Choose our best products
                  <i class="fas fa-graduation-cap ml-2"></i>
                </a>
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
        </div>
        <!--/First slide-->
        <!--Second slide-->
        <div class="carousel-item">
          <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg'); background-repeat: no-repeat; background-size: cover;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">
              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                <strong>Shoping for happy persion</strong>
                </h1>
                <p>
                  <strong>Best & comfortable online market place</strong>
                </p>
                <p class="mb-4 d-none d-md-block">
                  <strong>.</strong>
                </p>
                <a href="#" class="btn btn-outline-white btn-lg">Choose our best products
                  <i class="fas fa-graduation-cap ml-2"></i>
                </a>
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
        </div>
        <!--/Second slide-->
        <!--Third slide-->
        <div class="carousel-item">
          <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg'); background-repeat: no-repeat; background-size: cover;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">
              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                <strong>Shoping for happy persion</strong>
                </h1>
                <p>
                  <strong>Best & comfortable online market place</strong>
                </p>
                <p class="mb-4 d-none d-md-block">
                  <strong>.</strong>
                </p>
                <a href="#" class="btn btn-outline-white btn-lg">Choose our best products
                  <i class="fas fa-graduation-cap ml-2"></i>
                </a>
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
        </div>
        <!--/Third slide-->
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
    <!--Main layout-->
    <main>
      <div class="container">
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">
          <!-- Navbar brand -->
          <span class="navbar-brand">About Us:</span>
        </div>
        <h3 class="blue-text text-center">This is a beta vertiion app so some fitcher will change...</h1>
      </main>
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