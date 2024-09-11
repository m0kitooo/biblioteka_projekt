<?php
    $searchInputVal = $_POST["searchInputVal"];
    $categoryId = $_POST["categoryId"];     //kod w javascript niby ustawia wartosc null jak cat id nie ustawione ale php to czyta jako '' nwm czy to do konca prawda

    require("db.php");
    $sql = "SELECT id, nazwa FROM ksiazki WHERE nazwa LIKE '$searchInputVal%'";
    $result = $conn->query($sql);

    if($result->num_rows > 0 && $searchInputVal !== "" && $categoryId === "") {
        while($row = $result->fetch_object()) {
            echo "
                <p><a href='details.php?bookId={$row->id}'>$row->nazwa</a></p>
            ";
        }
    }

    $sql = "SELECT id, idKategorii, nazwa, obrazek FROM ksiazki WHERE idKategorii = '$categoryId' AND nazwa LIKE '$searchInputVal%'";
    $result = $conn->query($sql);

    if($result->num_rows > 0 && $searchInputVal !== "" && $categoryId !== "") {
        while($row = $result->fetch_object()) {
            echo "
                <p><a href='details.php?bookId={$row->id}'>$row->nazwa</a></p>
            ";
        }
    }

    $conn->close();
?>