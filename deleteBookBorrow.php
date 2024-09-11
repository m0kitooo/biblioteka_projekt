<?php
    require("db.php");
    $bookId = $_POST["bookId"];
    $userId = $_POST["userId"];

    $sql = "DELETE FROM wypozyczenia WHERE idKsiazki = '$bookId' AND idUzytkownika = '$userId'";
    $conn->query($sql);
    $sql = "UPDATE ksiazki SET ilosc = ilosc + 1 WHERE id = '$bookId'";
    $conn->query($sql);
    $conn->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>