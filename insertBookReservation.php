<?php
    require("db.php");
    session_start();
    $userId = $_SESSION["userId"];
    $bookId = $_GET["bookId"];

    $sql = "SELECT ilosc FROM ksiazki WHERE id = '$bookId'";
    $result = $conn->query($sql);
    $row = $result->fetch_object();
    
    $sql = "SELECT id FROM rezerwacje WHERE idKsiazki = '$bookId' AND idUzytkownika = '$userId' LIMIT 1";
    $result = $conn->query($sql);
    //nowe
    $sql = "SELECT dataWypozyczenia FROM wypozyczenia WHERE idKsiazki = '$bookId' AND idUzytkownika = '$userId' LIMIT 1";
    $result2 = $conn->query($sql);
    echo "<form id='redirectForm' action='details.php?bookId={$bookId}' method='post'>";

    if($row->ilosc <= 0) {
        echo "<input type='hidden' name='result' value='Brak książki na stanie'>";
    } elseif($result->num_rows > 0) {
        echo "<input type='hidden' name='result' value='Możesz zrobić tylko jedną rezerwacje danej książki na konto'>";
    } elseif($result2->num_rows > 0) {
        echo "<input type='hidden' name='result' value='Nie możesz zarezerwować książki, którą wypożyczyłeś'>";
    } else {
        echo "<input type='hidden' name='result' value='Zarezerwowano książkę'>";
        $sql = "INSERT INTO rezerwacje (idKsiazki, idUzytkownika) VALUES ('$bookId', '$userId')";
        $conn->query($sql);
        $sql = "UPDATE ksiazki SET ilosc = ilosc - 1 WHERE id = '$bookId'";
        $conn->query($sql);
        $conn->close();
    }

    echo "</form>";
    // header("Location: details.php?bookId={$bookId}");
    // exit();
?>
<script>
    document.getElementById('redirectForm').submit();
</script>