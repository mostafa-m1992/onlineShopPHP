<?php

$con = mysqli_connect("localhost","","root","","digikala");

$id = $_POST['id'];
$email = $_POST['email'];
$query = "select * from tbl_register where email='" . $email . "'";
$row = mysqli_query($con, $query);
if(mysqli_num_rows($row)> 0)
echo "error";
else
echo "ok";