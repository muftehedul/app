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
if(isset($_POST["insert"]))
{
$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
$name = $_POST["name"];
$type = $_POST["type"];
$price = $_POST["price"];
$rating = $_POST["rating"];
$description = $_POST["description"];
$query = "INSERT INTO shopingCart(name,category,price,rating,description,images) VALUES ('$name','$type','$price','$rating','$description','$file')";
if(mysqli_query($connect, $query))
{
echo '<script>alert("Image Inserted into Database")</script>';
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
            <li class="nav-item">
              <a class="nav-link waves-effect" href="orderDetails.php">Order Details</a>
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
    
    <div class="container" style="width:80%;">
      <br/><br/><br>
      <h3 align="center">Insert and Display Images and product details</h3>
      <br />
      <form method="post" enctype="multipart/form-data">
        <label for="exampleFormControlInput1">name:</label>
        <input type="text" class="form-control" placeholder="name" name="name">
        <label for="exampleFormControlInput1">Select type:</label>
        <select class="form-control" name="type">
          <option value="fashion">fashion</option>
          <option value="cosmetics">cosmetics</option>
          <option value="gadgets">electronical gadgets</option>
        </select>
        <label for="exampleFormControlInput1">Price:</label>
        <input type="text" class="form-control" placeholder="price" name="price">
        <label for="exampleFormControlInput1">give rating 1-5:</label>
        <input type="text" class="form-control" placeholder="rating" name="rating">
        <label for="exampleFormControlInput1">description:</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="description"></textarea>
        <label for="exampleFormControlInput1">upload product picture:</label>
        <input type="file" name="image" id="image" />
        <br />
        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
      </form>
      <br />
      <br />
      <table class="table table-bordered">
        
        
        <?php
        $query = "SELECT * FROM shopingCart ORDER BY id DESC  limit 5";
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
          </td>
        </tr>
        ';
        }
        ?>
      </table>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
    $('#insert').click(function(){
    var image_name = $('#image').val();
    if(image_name == '')
    {
    alert("Please Select Image");
    return false;
    }
    else
    {
    var extension = $('#image').val().split('.').pop().toLowerCase();
    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
    {
    alert('Invalid Image File');
    $('#image').val('');
    return false;
    }
    }
    });
    });
    </script>
  </body>
</html>