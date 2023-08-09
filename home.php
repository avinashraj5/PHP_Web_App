<?php
session_start();
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
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        .table {
            margin-top: 20px;
        }

        .add-user-button {
            margin-bottom: 20px;
        }

        .add-user-form {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
    <h5> Welcome Admin <?php echo $name ?></h5>
        <h2>Admin Page</h2>
        <a href="adminuser.php"><button class="btn btn-primary add-user-button">Add New Teacher</button></a>
        <form action="import_teachers.php" method="POST" enctype="multipart/form-data">
        <label for="excel_file">Choose Excel File:</label>
        <input type="file" name="excel_file" accept=".csv" required><br>
        <input class="btn btn-warning add-user-button" type="submit" value="Import Teachers">
  </form>
        <table class="table">
            <p>Teacher List</p>
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
          <?php
          include 'dbcon.php';
          $selectquery = "select * from signup order by cid DESC";
          $query = mysqli_query($con,$selectquery);
          while($row = mysqli_fetch_array($query)){
          ?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['mobile'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><img alt="ecommerce" src="<?php echo $row['image'];?>"style="width:80%;height:100%;border-radius:12px;"></td>
                    <td>
                    <a href="adminedit.php?id=<?php echo $row['cid'];?>"><button class="btn btn-primary edit-button">Edit</button></a>
                    <a href="adminuser.php?del=<?php echo $row['cid'];?>"><button class="btn btn-danger delete-button">Delete</button></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
</body>
</html>
