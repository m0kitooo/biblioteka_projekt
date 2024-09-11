<?php
    $categoryName = $_POST["categoryName"];

    require("db.php");
    $sql = "INSERT INTO kategorie (nazwa) VALUES ('$categoryName')";
    $conn->query($sql);
    $conn->close();

    header("Location: categories.php");
?>