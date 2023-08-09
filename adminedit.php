<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
if(!isset($_SESSION['id'])){
    echo "You are logged out";
    header('location:login.php');
  }
?>
<?php
$id=$_SESSION['id'];
$name =$_SESSION['name'];
$email =$_SESSION['email'];
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
        <h2>Edit User Information</h2>
        <?php
        include 'dbcon.php';
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        $selectquery = "select * from signup where cid = '$id'";
        $query = mysqli_query($con,$selectquery);
        while($row = mysqli_fetch_array($query)){
            ?>




        <form ction ="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST" enctype ="multipart/form-data">
      </p>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="<?php echo $row['name'];?>" value="<?php echo $row['name'];?>" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="number" id="mobile" class="form-control" name="mobile" placeholder="<?php echo $row['mobile'];?>" value="<?php echo $row['mobile'];?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="<?php echo $row['email'];?>" value="<?php echo $row['email'];?>" required>
            </div>
            <div class="form-group">
                <label for="mobile">Gender:</label>
                <input type="gender" id="gender" class="form-control" name="gender" placeholder="<?php echo $row['gender'];?>" value="<?php echo $row['gender'];?>" required>
            </div>
            <div class="form-group">
                <label for="email">Address:</label>
                <input type="address" id="address" class="form-control" name="address" placeholder="<?php echo $row['address'];?>" value="<?php echo $row['address'];?>" required>
            </div>
            <div class="form-group">
            <label for="email">Upload Image:</label>
            <input type="file" id="myFile" name="proof" value="<?php echo $row['image'];?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Edit Info</button>
            <div class="register-link">
                <a href="home.php" id="show-login-form"><- Back</a>
            </div>
        </form>
        <?php
        }}
        ?>
      </div>
</body>
</html>



<?php
include'dbcon.php';
if(isset($_POST['submit']))
{
  $name =$_POST['name'];
  $mobile = $_POST['mobile'];
  $gender =$_POST['gender'];
  $address = $_POST['address'];
  $email1 =$_POST['email'];
  $file=$_FILES['proof'];
    $filename = $file['name'];
      $filepath = $file['tmp_name'];
      $fileerror = $file['error'];
      if($fileerror == 0){
        $destfile = 'proof/'.$filename;
        move_uploaded_file($filepath, $destfile);

  $email= strtolower($email1);
  $updatequery = "update signup set name='$name ', email='$email', mobile ='$mobile', gender='$gender', address ='$address',image ='$destfile' where cid='$id' ";    
    $res = mysqli_query($con,$updatequery);

if($res)
{
  ?>
  <script>
    alert("The Information is Updated");
  location.replace("home.php");
  </script>
  <?php
}else{
    ?>
  <script>
        alert("The Information is Not Updated");
  location.replace("home.php");
  </script>
  <?php
}}
}
?>

