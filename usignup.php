<?php
session_start();
?>
<html>
    <head>
        <title>Add teacher Form</title>
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
      max-width: 65%;
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
    <?php include 'link/link.php'?>
    <body>
      <header>
</header>
<div class="content">
  <h3 style="font-family:Serif;color:black;text-align:center;font-size:35px">Add new Teacher Form</h3>
  <p class="bg-success text-white px-1"><?php
  if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  }
  ?>
</p>
  <p class = "divider-text"></p>

<form action ="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST" enctype ="multipart/form-data">
<div class="row">
    <div class="form-group col-sm-9">
      <label for="inputEmail4">Name :</label>
      <input type="name" class="form-control" id="inputname4" name="name" placeholder="Enter Your Name" required>
    </div>
    <div class="form-group col-sm-3">
      <label for="inputEmail4">Gender :</label>
      <select name="gender" id="country" class="form-control" required>
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
               </select>    </div>
  </div>
<div class="row">
    <div class="form-group col-sm-6">
      <label for="inputEmail4">Email :</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email" required>
    </div>
    <div class="form-group col-sm-6">
      <label for="inputPassword4">Mobile Number :</label>
      <input type="mobile" class="form-control" id="inputmobile4" name="mobile" placeholder="Mobile Number" required>
    </div>
  </div>
  <div class="row">
  <div class="form-group col-sm-6">
      <label for="inputPassword4">Password :</label>
      <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder="Password" required>
    </div>
    <div class="form-group col-sm-6">
      <label for="inputPassword4">Confirm Password :</label>
      <input type="password" class="form-control" id="inputPassword4" name="cpass" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address :</label>
    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St" required>
  </div>
  
  <div class="form-group">
  <p style="font-family:Serif;color:white;text-align:left;font-size:15px">Click on the "Choose File" button to upload a photo of the good :</p>
  <input type="file" id="myFile" name="proof" required>
  </div>
  
  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label" for="gridCheck">
       Already Have Account <a href="ulogin.php">Login</a> here.
      </label>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
  </div>
  <div class="col-sm-6">
  <button type="submit" name="submit" class="btn btn-primary" style="padding: 10px 100px;">Sign in</button>
  </div>
  </div>
</form>
</div>
</body>
</html>



<?php
include'database/dbcon.php';
if(isset($_POST['submit']))
{
date_default_timezone_set("Asia/Calcutta");
$gender=mysqli_real_escape_string($con, $_POST['gender']);
$username = mysqli_real_escape_string($con, $_POST['name']);
$email1 = mysqli_real_escape_string($con, $_POST['email']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
$password = mysqli_real_escape_string($con, $_POST['pass']);
$cpassword = mysqli_real_escape_string($con, $_POST['cpass']);
$address = mysqli_real_escape_string($con, $_POST['address']);

$pass = password_hash($password, PASSWORD_BCRYPT);
$cpass = password_hash($cpassword, PASSWORD_BCRYPT);
$email= strtolower($email1);

$token =bin2hex(random_bytes(15));
$file=$_FILES['proof'];
$filename = $file['name'];
      $filepath = $file['tmp_name'];
      $fileerror = $file['error'];
      if($fileerror == 0){
        $destfile = 'proof/'.$filename;
        move_uploaded_file($filepath, $destfile);
      

$emailquery =" select * from signup where email ='$email' ";
$query = mysqli_query($con, $emailquery);

$emailcount = mysqli_num_rows($query);
if($emailcount>0)
{
  $_SESSION['msg'] ="$email These Mail ID is Already taken You have Recive Mail";
  ?>
  <script>
  location.replace("ulogin.php");
  </script>
  <?php
}
else{
  if($password == $cpassword)
  {
$insertquery ="insert into signup(name,gender,mobile,email,password,cpassword,address,image,token) 
values('$username','$gender','$mobile','$email','$pass','$pass','$address','$destfile','$token')";

$iquery = mysqli_query($con, $insertquery);

if($iquery)
{
    $_SESSION['msg'] ="Check your mail account $email You recive OTP";
    ?>
    <script>
    location.replace("ulogin.php");
    </script>
    <?php
}else{
    ?>
    <script>
      alert("No Inserted ")
    </script>
    <?php
}
  }else{
    $_SESSION['msg'] ="Your Password is Not matching Try Again ";
   }
}
}

}
?>