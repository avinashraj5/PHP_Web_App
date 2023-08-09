<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login and Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn {
            width: 100%;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .hide {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form ction ="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST">
        <p class="bg-success text-white px-1"><?php
        if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        }else{
          echo $_SESSION['msg'] = "Enter your correct Information to Register.";
        }
        ?>
      </p>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="number" id="mobile" class="form-control" name="mobile" placeholder="Mobile Number" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" name="pass" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
            <div class="register-link">
                <a href="login.php" id="show-login-form">Login</a>
            </div>
        </form>
      </div>
</body>
</html>



<?php
include'dbcon.php';
if(isset($_POST['submit']))
{
  $name =$_POST['name'];
  $mobile = $_POST['mobile'];
  $email1 =$_POST['email'];
  $pass = $_POST['pass'];
  $email= strtolower($email1);
  $emailquery =" select * from signup where email ='$email' ";
$query = mysqli_query($con, $emailquery);

$emailcount = mysqli_num_rows($query);
if($emailcount>0)
{
$_SESSION['msg'] ="$email These Mail ID is Already taken You have Recive Mail";
?>
<script>
location.replace("login.php");
</script>
<?php
}else{
  $insertquery ="insert into signup(name,mobile,email,pass) 
values('$name','$mobile','$email','$pass')";

$iquery = mysqli_query($con, $insertquery);

if($iquery)
{
  $_SESSION['msg'] ="Check your was created account";
  ?>
  <script>
  location.replace("login.php");
  </script>
  <?php
}
}




}

?>