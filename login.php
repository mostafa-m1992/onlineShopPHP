<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

$query="SELECT * FROM tbl_register WHERE email=:email AND password=:password";

$statement = $pdo->prepare($query);

$statement ->bindvalue(':email', $_REQUEST['email']);
$statement ->bindvalue(':password', $_REQUEST['password']);
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);

if ($row==false) {
    echo "username or password is false";
}
else {
    echo $row["email"];
    //echo $row["email"].$row["image"];
}
