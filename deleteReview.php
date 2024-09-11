<?php
    require("db.php");
    $bookId = $_POST["bookId"];
    $reviewId = $_POST["reviewId"];

    $sql = "DELETE FROM recenzje WHERE id = $reviewId";
    $conn->query($sql);

    header("Location: details.php?bookId=$bookId");
    exit;
?>