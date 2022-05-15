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

$sql = "DELETE FROM tbl_basket WHERE id =  :id";
$statement = $pdo ->prepare($sql);
$statement ->bindParam(':id', $id);
$statement ->execute();

?>
