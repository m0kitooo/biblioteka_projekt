<?php
    $categoryId = $_POST["categoryId"];
    $categoryName = $_POST["categoryName"];

    require("db.php");
    $sql = "UPDATE kategorie SET nazwa = '$categoryName' WHERE id = '$categoryId'";
    $conn->query($sql);
    $conn->close();

    header("Location: categories.php");
?>