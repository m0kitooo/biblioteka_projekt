<?php
    session_start();

    $userId = $_SESSION["userId"];
    $bookId = $_POST["bookId"];
    $rating = $_POST["star-rating"];
    $description = $_POST["description-review"];
    
    require("db.php");

    $sql="INSERT INTO recenzje (idUzytkownika, idKsiazki, ocena, tresc) VALUES ('$userId', '$bookId', '$rating', '$description')";

    $conn->query($sql);

    $conn->close();
    header("Location: details.php?bookId=$bookId");
    exit;
?>