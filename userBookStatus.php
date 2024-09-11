<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userBookStatus.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
            require("db.php");
        ?>
    </header>
    <?php
        $userId = $_GET["userId"];
        $sql = "SELECT nick FROM uzytkownicy WHERE id = '$userId'";
        $result = $conn->query($sql);
        $row = $result->fetch_object();

        echo "
            <div class='center-grid-container'>
                <p>{$row->nick}</p>
        ";

        $sql = "SELECT idUzytkownika, idKsiazki, k.id, nazwa FROM wypozyczenia, ksiazki k WHERE idUzytkownika = '$userId' AND idKsiazki = k.id";
        $result = $conn->query($sql);

        while($row = $result->fetch_object()) {
            echo "
                <form action='deleteBookBorrow.php' method='post'>
                    <input type='hidden' name='userId' value='{$row->idUzytkownika}'>
                    <input type='hidden' name='bookId' value='{$row->idKsiazki}'>
                    <p>{$row->nazwa} <button type='submit'>Usuń wypożyczenie</button></p>
                </form>
            ";
        }

        $sql = "SELECT idUzytkownika, idKsiazki, k.id, nazwa FROM rezerwacje, ksiazki k WHERE idUzytkownika = '$userId' AND idKsiazki = k.id";
        $result = $conn->query($sql);
        
        while($row = $result->fetch_object()) {
            echo "
                <form action='deleteReservationInsertBorrow.php' method='post'>
                    <input type='hidden' name='userId' value='{$row->idUzytkownika}'>
                    <input type='hidden' name='bookId' value='{$row->idKsiazki}'>
                    <p>{$row->nazwa} <button type='submit'>Dodaj wypożyczenie</button></p>
                </form>
            ";
        }

        echo "</div>";

        $conn->close();
    ?>
    <footer>
        <?php
            require("footer.php");
        ?>
    </footer>
</body>
</html>