<?php
include 'dbcon.php';
if(isset($_GET['del'])){
    $id = $_GET['del'];
    $updatequery = "delete from signup where cid='$id' ";    
    $res = mysqli_query($con,$updatequery);

if($res)
{
  ?>
  <script>
    alert("The Information is Deleted");
  location.replace("home.php");
  </script>
  <?php
}else{
    ?>
  <script>
        alert("The Information is Not Deleted");
  location.replace("home.php");
  </script>
  <?php
}
}
?>








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
 
  <div class="form-group">
    <label for="inputAddress">Address :</label>
    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St" required>
  </div>
  <div class="form-group">
  <p style="font-family:Serif;color:white;text-align:left;font-size:15px">Click on the "Choose File" button to upload a photo of the good :</p>
  <input type="file" id="myFile" name="proof" required>
  </div>
  <br>
  <div class="row">
    <div class="col-sm-4">
  </div>
  <div class="col-sm-6">
  <button type="submit" name="submit" class="btn btn-primary" style="padding: 10px 100px;">Add Teacher</button>
  </div>
  <a href="home.php" id="show-login-form"><- Back</a>
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

$address = mysqli_real_escape_string($con, $_POST['address']);
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
  ?>
  <script>
  location.replace("home.php");
  </script>
  <?php
}
else{
 
$insertquery ="insert into signup(name,gender,mobile,email,address,image,token) 
values('$username','$gender','$mobile','$email','$address','$destfile','$token')";

$iquery = mysqli_query($con, $insertquery);

if($iquery)
{
    ?>
    <script>
      alert("New Teacher Added Sucessfully ")
   location.replace("home.php");
    </script>
    <?php
}else{
    ?>
    <script>
      alert("No Inserted ")
    </script>
    <?php
}
}
      }
}

?>