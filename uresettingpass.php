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
  <title>Password Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
        * {
    margin: 0; padding: 0;
}
html, body, #container {
    height: 100%;
}
header {
    height: 11%;
}
label{
        text-align: left;
        color:black;
       }
       h3{
        text-align: center;
        color:black;
       }
       p{
        text-align: center;
        color:black;
       }
      
.content {
  backdrop-filter: blur(10px);
    max-width: 35%;
    margin:auto;
    padding: 10px;
    border: 5px solid black;
  }
  .divider-text{
  position: relative;
  text-align: center;
  margin-top: 15px;
  margin-bottom: 15px;
  padding : 5px;
  
}
.divider-text span{
  padding: 7px;
  font-size: 12px;
  position: relative;
  z-index: 2;
}
.divider-text::after{
  content: "";
  position: absolute;
  width: 100%;
  border-bottom: 5px solid black;
  top: 55%;
  left: 0;
  z-index: 1;
}
    </style>
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
        <li class="nav-item">
        <a href="uprofile.php" class="nav-link">Profile</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="uresettingpass.php">Change Password</a>
        </li>
        <li class="nav-item">
        <a href="ulogout.php" class="nav-link" href="#">Logout</a>
        </li>
      </ul>
    </div>
  </nav><br><br>
<div class="content">
<h3 style="font-family:Serif;color:black;text-align:center;font-size:35px">Password Reset</h3>
  <p style="font-family:Serif;color:black;text-align:center;font-size:20px">Reset Your Password.</p>
  
  <p class = "divider-text"></p>


  <form ction ="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST">
<div class="row">
<div class="form-group col-sm-12">
      <label for="inputPassword4">Password :</label>
      <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder="Password" required>
    </div>
    <div class="form-group col-sm-12">
      <label for="inputPassword4">Confirm Password :</label>
      <input type="password" class="form-control" id="inputPassword4" name="cpass" placeholder="Password" required>
    </div>
  </div>


  <div class="row">
    <div class="col-sm-3">
  </div>
  <div class="col-sm-6">
  <button type="submit" name="submit" class="btn btn-primary" style="padding: 10px 100px;">Reset</button>
  </div>
  </div><br>
</form>
</div>
</body>
</html>

<?php
include'database/dbcon.php';
if(isset($_POST['submit']))
{
  $token=$_SESSION['token'];
  $password = mysqli_real_escape_string($con, $_POST['pass']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpass']);
  $pass = password_hash($password, PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword, PASSWORD_BCRYPT);   
  $emailquery =" select * from signup where token ='$token' ";
  $query = mysqli_query($con, $emailquery);
  
  $emailcount = mysqli_num_rows($query);
  if($emailcount)
  {
    if($password == $cpassword)
  {
    $updatequery = "update signup set password='$pass' , cpassword='$cpass' where token='$token' ";

$iquery = mysqli_query($con, $updatequery);

    if($iquery){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] ="Password Reset Successfully";
            ?>
            <script>
                location.replace("ulogin.php");
            </script>
            <?php
        }else{
            
        }
        }
}else{
    ?>
    <script>
                alert("Password is not matching Try Again !!.")

        location.replace("uresettingpass.php");
    </script>
    <?php
}
}}
?>
