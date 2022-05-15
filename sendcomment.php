<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}



$id = $_GET["id"];
$email = $_GET["email"];
$imageuser = $_GET["image"];
$comment = $_GET["comment"];
$negative = $_GET["negative"];
$positive = $_GET["positive"];
$rating = $_GET["rating"];

$query = "INSERT INTO tbl_comment (user, image, comment, positive, negative, rating, idproduct) VALUES (:email,:image,:comment,:positive,:negative,:rating,:idproduct) ";

$statement = $pdo->prepare($query);

$statement ->bindParam(":email", $email);
$statement ->bindParam(":image", $imageuser);
$statement ->bindParam(":positive", $positive);
$statement ->bindParam(":comment", $comment);
$statement ->bindParam(":negative", $negative);
$statement ->bindParam(":rating", $rating);
$statement ->bindParam(":idproduct", $id);

$statement ->execute();

echo "1";
