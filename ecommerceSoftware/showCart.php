<?php
// Initialize the session
session_start();
$userId=$_SESSION['id'];
require_once "additional/dbConnect.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: login.php");
exit;
}
?>
<?php
$connect = mysqli_connect($host, $user, $password, $database);
if(isset($_POST["cartId"]))
{

$cartId = $_POST["cartId"];

$query = "DELETE FROM cart WHERE id=$cartId and user_id=$userId;";
if(mysqli_query($connect, $query))
{
echo '<script>alert("Cart removed from your cart list")</script>';
}
}
?>
<!DOCTYPE html>
<html>
  <head>
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
    
    <div class="container" style="width:90%;">
      <br/><br/><br>
      <h3 align="center">Check your carts and place your order</h3>
      <br />
      <br />
      <table class="table table-bordered table-hover table-striped">
        
        
        <?php
        $detailsSum='';
        $priceSum=0;
        $query = "SELECT cart.id as id,shopingcart.name AS name,shopingcart.price AS price,shopingcart.rating AS rating,shopingcart.description AS description,shopingcart.images as images
        FROM shopingcart,cart
        WHERE shopingcart.id= cart.shopingcart_id AND cart.user_id=$userId
        ORDER BY id DESC;
        ";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
        echo '
        <tr >
          <th>Image</th>
          <th>Detail</th>
        </tr>
        <tr>
          <td>
            <img src="data:image/jpeg;base64,'.base64_encode($row['images'] ).'" height="200" width="200" class="img-thumnail" />
          </td>
          <td>
            '.'product name: '.$row['name'] .'
            '.'<br>price: '.$row['price'] .' TK'.'
            '.'<br>product rating: '.$row['rating'] .'
            '.'<br>product description: <p>'.$row['description'] .'</p>
            <form method="post" enctype="multipart/form-data">
              <button type="submit" name="cartId" id="insert" value="'.$row['id'] .'" class="btn btn-danger" />remove_cart</button>
            </form>
            
          </td>
        </tr>
        
        ';
        $detailsSum = $detailsSum.', '. $row['name'] .' '.$row['description'];
        $priceSum+=$row['price'];
        }
        echo '
        <tr >
          <td><b>ORDERS: '.$detailsSum.'</b></td>
          <td><b>Total cost '.$priceSum.' TK</b>
            <form method="post" action="checkout.php">
              <button type="submit" name="totalBill" id="insert" value="'.$priceSum.'" class="btn btn-success" />Checkout</button>
            </form>
          </td>
        </tr>';
        ?>
      </table>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
  </body>
</html>