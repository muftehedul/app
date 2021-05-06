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
if(isset($_POST["confirmOrder"]))
{
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$address=$_POST["address"];
$pcode=$_POST["pcode"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$transactionId=$_POST["transactionId"];
$totalAmount=0;

$shopingcart_ids='';
$query = "SELECT shopingcart.id as id,shopingcart.name AS name,shopingcart.price AS price,shopingcart.rating AS rating,shopingcart.description AS description,shopingcart.images as images
FROM shopingcart,cart
WHERE shopingcart.id= cart.shopingcart_id AND cart.user_id=$userId
ORDER BY id DESC;
";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result))
{
  $shopingcart_ids=$shopingcart_ids.$row['id'].',';
  $totalAmount+=$row['price'];
}


$query = "INSERT INTO orders(firstName, lastName, address, postalCode, phone, email, bkashTransactionId, productIds, totalAmount) VALUES ('$fname','$lname','$address','$pcode','$phone','$email','$transactionId','$shopingcart_ids',$totalAmount);";
if(mysqli_query($connect, $query))
{
  $sql = "DELETE FROM cart WHERE user_id=$userId;";
if(mysqli_query($connect, $sql)){
   echo "previous cart cleared";
}

echo '<script>alert("your order is placed successfuly")</script>';
}else{
echo '<script>alert("some error occerus please try again")</script>';
}

}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>YourShop</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
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
    
    <div class="container">
      <br/><br/><br>
      <h3 align="center">Please fill the form with details, pay the amount and confirm your order</h3>
      <br />
      <br />
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="text-center"> Shipping Address And Details</h3>
        </div>
        <div class="panel-body">
          <!-- Order placing form -->
          <form method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-12 col-md-12">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>First Name</label>
                  <input name="fname" type="text" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <input name="lname" type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Address</label>
                  <input name="address" type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Postal Code</label>
                  <input name="pcode" type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Telephone/mobile No:</label>
                  <input name="phone" type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="email" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label><h3 class="text-success">Please pay total bill(<?php if(isset($_POST["totalBill"])){ echo $_POST["totalBill"]."Taka";}?>) to this bkash/rocket/nogod number 01091504*** and give the transaction id  or give payment cash on delivery<br>
                  transaction id :</h3></label>
                  <input name="transactionId" type="text" class="form-control" placeholder="bkash transaction id">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <input type="submit" name="confirmOrder" value="Confirm Order" class="form-control btn-info">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
  </body>
</html>