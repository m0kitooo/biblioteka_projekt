<?php
    require("db.php");
    session_start();

    $bookId = $_POST["bookId"];
    $userId = $_SESSION["userId"];
    $sql = "SELECT id FROM ulubione WHERE idKsiazki = $bookId AND idUzytkownika = $userId";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $id = $result->fetch_object()->id;
        $sql = "DELETE FROM ulubione WHERE id = $id";
    } else {
        $sql = "INSERT INTO ulubione (idKsiazki, idUzytkownika) VALUES ($bookId, $userId)";
    }
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        echo "success";
    }
    $conn->close();
?>