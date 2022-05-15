<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}



$email =$_GET["email"];
//$email ="mazad@mail.com";

$query="SELECT * FROM  tbl_basket WHERE cookie = :email ";
$statement = $pdo->prepare($query);
$statement ->bindParam(":email", $email);
$statement ->execute();
$basket = array();

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

    $record = array();
    $record["id"] = $row["id"];
    $record["image"] = $row["image"];
    $record["color"] = $row["color"];
    $record["garanty"] = $row["garanty"];
    $record["price"] = $row["price"];
    $record["number"] = $row["number"];

    $id = $row["idproduct"];
    $query2 ="SELECT * FROM  tbl_product WHERE id = :id";
    $statement2 = $pdo->prepare($query2);
    $statement2 ->bindParam(":id", $id);
    $statement2 ->execute();
    $row2 = $statement2->fetch(PDO::FETCH_ASSOC);
    $record["title"] = $row2["title"];

    $price = $row["price"];
    $record["allprice"] = $price * $record["number"];
    $basket[] = $record;

}

echo JSON_encode($basket);

?>
