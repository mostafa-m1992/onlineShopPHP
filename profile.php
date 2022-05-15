<?php

include "config.php";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connect Successfully. Host info: " . $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}


try {
    $query = "SELECT * FROM tbl_register WHERE email = :email";
    $statement = $pdo->prepare($query);
    $statement->execute();

    $sql =" UPDATE tbl_register SET username = :username , phone = :phone , address = :address WHERE email = :email";
    $statement = $pdo->prepare($sql);

    $statement ->bindvalue(':email', $_GET['email']);
    $statement ->bindvalue(':username', $_REQUEST['username']);
    $statement ->bindvalue(':phone', $_REQUEST['phone']);
    $statement ->bindvalue(':address', $_REQUEST['address']);
    $statement->execute();

    echo "Editing information completed successfully";
} catch (PDOException $e) {
    echo "The required fields are not filled";
}