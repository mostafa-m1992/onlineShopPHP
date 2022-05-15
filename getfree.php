<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}



$date = date("Y-m-d");
$free = 0;
$getprice = 0;

$query = "SELECT * FROM tbl_product WHERE date='$date' LIMIT 5";
$statement = $pdo->prepare($query);
$statement->execute();
$category = array();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
    $record  =array();

    $free = $row["label"];
    $getprice = $row["price"];

    $totalfree = $getprice*$free/100;
    $totalfreefinal = $getprice-$totalfree;
    $record["freeprice"] = $totalfreefinal;

    if($free == 0){
        $totalfree = 0;
    }

    $record["id"] = $row["id"];
    $record["title"] = $row["title"];
    $record["image"] = $row["image"];
    $record["visit"] = $row["visit"];
    $record["price"] = $row["price"];
    $record["label"] = $row["label"];
    $record["date"] = $row["date"];

    $category[] = $record;

    /*$labelUpdate="UPDATE tbl_product SET label=0 WHERE date<'$date'";

    $result=$conn->prepare($labelUpdate);
    $result->execute();*/

}

echo JSON_encode($category);