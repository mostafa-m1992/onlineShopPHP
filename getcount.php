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
//$email="mazad@mail.com";
$number = 0;
$count = 0;

$query = "SELECT * FROM tbl_basket WHERE cookie = :email";
$statement = $pdo ->prepare($query);
$statement ->bindParam(":email", $email);
$statement ->execute();

while ($row = $statement ->fetch(PDO::FETCH_ASSOC)) {

    if ($row == false) {
        echo "0";
    }
    else {
        $number = $row["number"];
        $count = $count + $number;
    }
}
echo $count;

?>
