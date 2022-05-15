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
//$id = 4;
$query = "SELECT * FROM tbl_gallery WHERE idproduct = :id ";
$statement = $pdo->prepare($query);
$statement ->bindParam(":id", $id);
$statement->execute();
$pics = array();
while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
    $record = array();
    $record["pics"] = $row["image"];
    $pics[] = $record;
}

echo JSON_encode($pics);