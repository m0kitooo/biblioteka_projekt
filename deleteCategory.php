<?php
    $categoryId = $_POST["categoryId"];

    require("db.php");
    $sql = "DELETE FROM kategorie WHERE id = '$categoryId'";
    $conn->query($sql);
    $conn->close();

    header("Location: categories.php");
?>