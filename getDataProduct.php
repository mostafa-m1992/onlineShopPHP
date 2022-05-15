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
// $id=1;
$ratingcount = 0;
$finalrating = 0;
$totalrating = 0;
$free = 0;
$getprice = 0;
$totlafree = 0;

$query = "SELECT * FROM tbl_product WHERE id = :id";
$statement = $pdo->prepare($query);
$statement ->bindParam(":id", $id);
$statement->execute();
$product = array();
while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
    $record = array();
    $free = $row["label"];
    $getprice = $row["price"];

    $totlafree = $getprice * $free/100;
    $totlafreefinal = $getprice - $totlafree;
    $record["freeprice"] = $totlafreefinal;
    if ($free == 0) {
        $totlafree = 0;
    }
    $record["id"] = $row["id"];
    $record["image"] = $row["image"];
    $record["title"] = $row["title"];
    $record["visit"] = $row["visit"];
    $record["price"] = $row["price"];
    $record["label"] = $row["label"];
    $record["date"] = $row["date"];
    $record["only"] = $row["only"];
    $record["sale"] = $row["sale"];
    $record["color"] = $row["color"];
    $record["guarantee"] = $row["guarantee"];
    $record["description"] = $row["description"];

    $visit = $row["visit"];

    $sql1 = "UPDATE tbl_product SET visit = '$visit' +1 WHERE id = '$id'";
    $result2 = $pdo->prepare($sql1);
    $result2->execute();

    //// COLOR
    $query2 = "SELECT * FROM tbl_color WHERE id = :id";
    $statement2 = $pdo->prepare($query2);
    $statement2 ->bindParam(":id", $record["color"]);
    $statement2->execute();
    $row2 = $statement2->fetch(PDO::FETCH_ASSOC);
    $record["color"] = $row2["color"];

    //// guarantee
    $query3 = "SELECT * FROM tbl_guarantee WHERE id = :id";
    $statement3 = $pdo->prepare($query3);
    $statement3 ->bindParam(":id",$record["guarantee"]);
    $statement3->execute();
    $row3 = $statement3->fetch(PDO::FETCH_ASSOC);
    $record["guarantee"] = $row3["title"];

    $product[] = $record;



}

echo JSON_encode($product);