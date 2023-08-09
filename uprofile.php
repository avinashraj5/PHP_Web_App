<?php
session_start();
if(!isset($_SESSION['token'])){
    echo "You are logged out";
    header('location:ulogin.php');
  }
?>
<?php
$loginid=$_SESSION['token'];
$image =$_SESSION['image'];
$name =$_SESSION['name'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item active">
        <a href="uprofile.php" class="nav-link">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="uresettingpass.php">Change Password</a>
        </li>
        <li class="nav-item">
        <a href="ulogout.php" class="nav-link" href="#">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
<div class="content" style=" padding: 8px 8px;margin :10px;">
<div class="row" style="padding:5px;">
<div class="col-sm-10" style="padding:15px;">
<p style="font-family:Serif;color:black;text-align:center;font-size:30px"> Profile : </p>
</div>
<div class="col-sm-2" style="padding:15px;">
<a href="uprofile1.php"><button class="btn btn-outline-primary"  style="float: center;padding:5px;"> <i class="fa fa-edit" aria-hidden="true"></i>  Edit  </button></a>  
</div></div>

<p class = "divider-text"></p>

<?php
include 'database/dbcon.php';
$li=$_SESSION['token'];
$selectquery = "select * from signup  where token ='$li' ";
$query = mysqli_query($con,$selectquery);
while($result =mysqli_fetch_array($query)){
?>
<div class="row" style="padding:5px;">
<div class="col-sm-8" style="padding:15px;">
<form action ="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST" enctype ="multipart/form-data">
<div class="row" style="padding:5px;">

<div class="col-sm-12" style="padding:15px;">
      <label for="inputEmail4">Name :</label>
      <input type="age" name="age" class="form-control" id="inputnumber" value="<?php echo $result['name'];?>" placeholder="<?php echo $result['name'];?>" required>
      </div>
<div class="col-sm-6" style="padding:15px;">
      <label for="inputEmail4">Email :</label>
      <input type="age" name="age" class="form-control" id="inputnumber" value="<?php echo $result['email'];?>" placeholder="<?php echo $result['email'];?>" required>
</div>
<div class="col-sm-6" style="padding:15px;">
      <label for="inputEmail4">Mobile :</label>
      <input type="quantity" name="quantity" class="form-control" value="<?php echo $result['mobile'];?>" id="inputnumber" placeholder="<?php echo $result['mobile'];?>" required>
</div>
<div class="col-sm-12" style="padding:15px;">
      <label for="inputEmail4">Address :</label>
      <input type="price" name="price" class="form-control" value="<?php echo $result['address'];?>" id="inputnumber" placeholder="<?php echo $result['address'];?>" required>
</div>

</div>
</form>
</div>
<div class="col-sm-4" style="padding:15px;">
<img alt="ecommerce" src="<?php echo $result['image'];?>"style="width:80%;height:100%;border-radius:12px;">
</div>
<?php } ?>
</div>

</div>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>