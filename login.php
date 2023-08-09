<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
?>
<html>
    <head>
    <title>Login</title>   
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link herf="https://fonts.googleapis.com/css?family=Muli&display=swap">
  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js">
  </script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </head>
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
    <body>
      <header>
</header>
<div class="container">
<h3 style="font-family:Serif;color:black;text-align:center;font-size:35px">Login</h3>
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
  <div class="form-group">
                <label for="username">Username:</label>
                <input type="email" id="email" class="form-control" name="username" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
            <div class="register-link">
                <a href="signup.php" id="show-register-form">Register</a>
            </div>
</form>
</div>
</body>
</html>


<?php
include'dbcon.php';

if(isset($_POST['submit']))
{

    $email1 =$_POST['username'];
    $password = $_POST['password'];
    $email= strtolower($email1);
    $email_search =" select * from admin where email ='$email' and pass ='$password' ";
    
    $query = mysqli_query($con, $email_search);
    
    $email_count = mysqli_num_rows($query);
    if($email_count)
    {
    $email_pass = mysqli_fetch_assoc($query);
    $_SESSION['id'] =$email_pass['id'];
    $_SESSION['email'] =$email_pass['email'];
    $_SESSION['mobile'] =$email_pass['mobile'];
    $_SESSION['name'] =$email_pass['name'];

    
    ?>
    <script>
        alert("login sucessfully")
        location.replace("home.php");
    </script>
    <?php
    }else{

    }
}
?>