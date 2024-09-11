<?php
    require("db.php");

    session_start();
    $userId = $_SESSION["userId"];
    $reportContent = $_POST["reportContent"];

    $sql = "INSERT INTO zgloszenia (idUzytkownika, tresc) VALUES ('$userId', '$reportContent')";
    $conn->query($sql);
    $conn->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>