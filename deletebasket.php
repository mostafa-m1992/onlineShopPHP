<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}



$email = $_GET["email"];

$sql = "DELETE FROM tbl_basket WHERE cookie =  :email";
$statement = $pdo->prepare($sql);
$statement ->bindParam(':email', $email);
$statement ->execute();

?>
