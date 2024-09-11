<?php
    require("db.php");

    $bookId = $_POST["bookId"];
    $userId = $_POST["userId"];

    $sql = "SELECT ilosc FROM ksiazki WHERE id = '$bookId'";
    $result = $conn->query($sql);
    $row = $result->fetch_object();

    $sql = "SELECT id FROM wypozyczenia WHERE idKsiazki = '$bookId' AND idUzytkownika = '$userId' LIMIT 1";
    $result = $conn->query($sql);
    //nowe
    $sql = "SELECT dataRezerwacji FROM rezerwacje WHERE idKsiazki = '$bookId' AND idUzytkownika = '$userId' LIMIT 1";
    $result2 = $conn->query($sql);
    echo "<form id='redirectForm' action='details.php?bookId={$bookId}' method='post'>";

    if($row->ilosc <= 0) {
        echo "<input type='hidden' name='result' value='Brak książki na stanie'>";
    } elseif($result->num_rows > 0) {
        echo "<input type='hidden' name='result' value='Możesz wypożyczyć tylko jedną taką książke na konto'>"; 
    } elseif($result2->num_rows > 0) {
        echo "<input type='hidden' name='result' value='Zarezerwowałeś już tą książkę, zmień jej status w zakładce status książek'>"; 
    } else {
        $sql = "INSERT INTO wypozyczenia (idKsiazki, idUzytkownika) VALUES ('$bookId', '$userId')";
        $conn->query($sql);
        $sql = "UPDATE ksiazki SET ilosc = ilosc - 1 WHERE id = '$bookId'";
        $conn->query($sql);
    }

    echo "</form>";
    $conn->close();
?>
<script>
    document.getElementById('redirectForm').submit();
</script>