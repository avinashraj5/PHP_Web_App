<?php

$server ="localhost";
$user ="root";
$password ="";
$db ="login";

$con = mysqli_connect($server,$user,$password,$db);

if($con)
{

}else{
    ?>
    <script>
        alert("No connection ")
    </script>
    <?php
}
?>