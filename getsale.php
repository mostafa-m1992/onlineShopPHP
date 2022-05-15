<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}



$query = "SELECT * FROM tbl_product  ORDER BY  sale DESC  LIMIT  6";
$statement = $pdo->prepare($query);
$statement->execute();
$category = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
$record = array();

$record["id"] = $row["id"];
$record["title"] = $row["title"];
$record["image"] = $row["image"];
$record["visit"] = $row["visit"];
$record["price"] = $row["price"];

  $category[] = $record;
}

echo JSON_encode($category);