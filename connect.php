<?php
$host='localhost';
$user='myuser';
$password='mypassword';
$dbname='mydbname';
$con=mysqli_connect($host,$user,$password) or die(mysqli_error($con));
mysqli_select_db($con,$dbname) or die(mysqli_error($con));
?>