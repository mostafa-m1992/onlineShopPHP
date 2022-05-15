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
$color = $_GET["color"];
$guarantee = $_GET["guarantee"];
$image = $_GET["image"];
$price = $_GET["price"];
$count_insert = 1;
$count_update = 0;

$query = "SELECT * FROM tbl_basket WHERE cookie = :email AND idproduct = :id";
$statement = $pdo->prepare($query);
$statement ->bindParam(":id", $id);
$statement ->bindParam(":email", $email);
$statement ->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);
if ($row == false) {

    $sql  = "INSERT INTO tbl_basket (image,cookie,idproduct,number,color,guarantee,price)  VALUES (:image,:email,:id,:number,:color,:guarantee,:price)";
    $result = $pdo->prepare($sql);
    $result ->bindValue(":id", $id);
    $result ->bindValue(":email", $email);
    $result ->bindValue(":color", $color);
    $result ->bindValue(":guarantee", $guarantee);
    $result ->bindValue(":image", $image);
    $result ->bindValue(":price", $price);
    $result ->bindValue(":number", $count_insert);
    $result ->execute();
    echo "Product added to cart";

}
else {
    $number = $row["number"] ++;
    $count_update = $number +1;
    $idbasket = $row["id"];

    $sql1 = "UPDATE tbl_basket SET  number = :number WHERE id = :id";
    $result1 = $pdo->prepare($sql1);
    $result1 ->bindValue(":id", $idbasket);
    $result1 ->bindValue(":number", $count_update);
    $result1 ->execute();
    echo "Cart updated";

}

?>