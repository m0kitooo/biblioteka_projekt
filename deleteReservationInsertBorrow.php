<?php
    require("db.php");
    $bookId = $_POST["bookId"];
    $userId = $_POST["userId"];

    $sql = "DELETE FROM rezerwacje WHERE idKsiazki = '$bookId' AND idUzytkownika = '$userId'";
    $conn->query($sql);
    $sql = "UPDATE ksiazki SET ilosc = ilosc + 1 WHERE id = '$bookId'";
    $conn->query($sql);

    $sql = "SELECT ilosc FROM ksiazki WHERE id = '$bookId'";
    $result = $conn->query($sql);
    $row = $result->fetch_object();

    if($row->ilosc <= 0) {
        echo "xpp";
    } else {
        $sql = "INSERT INTO wypozyczenia (idKsiazki, idUzytkownika) VALUES ('$bookId', '$userId')";
        $conn->query($sql);
        $sql = "UPDATE ksiazki SET ilosc = ilosc - 1 WHERE id = '$bookId'";
        $conn->query($sql);
    }

    $conn->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>