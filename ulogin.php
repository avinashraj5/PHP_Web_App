<?php
session_start();
include'database/dbcon.php';
date_default_timezone_set("Asia/Calcutta");
?>
<html>
    <head>
    <title>Login Form</title>   
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
    margin-left: 20%;
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
    <?php include 'link/link.php'?>
    <body>
      <header>
</header>
<div class="content">
<h3 style="font-family:Serif;color:black;text-align:center;font-size:35px">Login Form</h3>
  <p style="font-family:Serif;color:black;text-align:center;font-size:20px">Login Your self.</p>
  <p class="bg-success text-white px-1"><?php
  if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  }else{
    echo $_SESSION['msg'] = "You are logged out. Please login again.";
  }
  ?>
</p>
  <p class = "divider-text"></p>

  <form ction ="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST">
<div class="row">
    <div class="form-group col-sm-12">
      <label for="inputEmail4">Email :</label>
      <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" 
      value ="<?php if(isset($_COOKIE['emailcookie'])){echo $_COOKIE['emailcookie']; } ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-12">
      <label for="inputEmail4">Password :</label>
      <input type="password" name="pass" class="form-control" id="inputPassword4" placeholder="Password"
      value ="<?php if(isset($_COOKIE['passwordcookie'])){echo $_COOKIE['passwordcookie']; } ?>" required>
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label" for="gridCheck">
      Do not Have Account <a href="usignup.php">Sign up</a> here.
      </label>
    </div>
  </div><br>
  <div class="row">
    <div class="col-sm-3">
  </div>
  <div class="col-sm-6">
  <button type="submit" name="submit" class="btn btn-primary" style="padding: 10px 100px;">Login</button>
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

    $email1 =$_POST['email'];
    $password = $_POST['pass'];
    $email= strtolower($email1);
    $email_search =" select * from signup where email ='$email'  ";
    
    $query = mysqli_query($con, $email_search);
    
    $email_count = mysqli_num_rows($query);
    if($email_count)
    {
      
    
    $email_pass = mysqli_fetch_assoc($query);

    $_SESSION['token'] =$email_pass['token'];
    $_SESSION['email'] =$email_pass['email'];
    $_SESSION['mobile'] =$email_pass['mobile'];
    $_SESSION['image'] =$email_pass['image'];
    $_SESSION['name'] =$email_pass['name'];

    
    $db_pass = $email_pass['password'];
    $pass_decode = password_verify($password, $db_pass);

    if($pass_decode)
    {
        ?>
      <script>
          alert("login sucessfully")
          location.replace("uhome.php");
      </script>
      <?php

    }else
    {
        $_SESSION['msg'] ="Your Password is Not matching Try Again ";
        ?>
        <script>
            location.replace("ulogin.php");
        </script>
        <?php
    }
    }else
    {
        $_SESSION['msg'] ="Invaild Mail ID";
        ?>
        <script>
            //alert("login sucessfully")
            location.replace("ulogin.php");
        </script>
        <?php
    }

}
?>