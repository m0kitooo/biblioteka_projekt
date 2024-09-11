<?php
    require('db.php');
    $id = $_POST["bookId"];

    $sql = "SELECT obrazek FROM ksiazki WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_object();

    $filePath = "imgs/databaseImgs/insertedBooks/" . $row->obrazek;

    unlink($filePath);

    $sql = "DELETE FROM ksiazki WHERE id = $id";
    $conn->query($sql);
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>