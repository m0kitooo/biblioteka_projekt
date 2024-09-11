<?php
    require("db.php");
    session_start();

    $bookId = $_POST["bookId"];
    $reviewId = $_POST["reviewId"];
    $content = $_POST["content"];
    $currentTime = date('Y-m-d H:i:s');
    $rate = $_POST["rate"];

    $sql = "UPDATE recenzje SET ocena = '$rate', tresc = '$content', dataZamieszczenia = '$currentTime' WHERE id = '$reviewId'";
    $conn->query($sql);
    header('Location: details.php?bookId=' . $bookId);
    exit();
?>