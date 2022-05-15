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
    //$id = 1;
    $query = "SELECT * FROM tbl_comment WHERE idproduct = :id AND confirm = 1";
    $statement = $pdo->prepare($query);
    $statement ->bindParam(":id", $id);
    $statement ->execute();

    $comment = array();

    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $record = array();
        $record["id"] = $row["id"];
        $record["image"] = $row["image"];
        $record["user"] = $row["user"];
        $record["comment"] = $row["comment"];
        $record["positive"] = $row["positive"];
        $record["negative"] = $row["negative"];
        $record["rating"] = $row["rating"];
        $record["confirm"] = $row["confirm"];
        $record["idproduct"] = $row["idproduct"];

        $comment[] = $record;
    }

    echo JSON_encode($comment);
