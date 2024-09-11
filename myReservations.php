<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje rezerwacje</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/myReservations.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
        ?>
    </header>
    <main>
        <?php
            require("db.php");
            $userId = $_SESSION["userId"];

            $sql = "SELECT idKsiazki, idUzytkownika, dataRezerwacji, k.id, nazwa, obrazek FROM rezerwacje, ksiazki k WHERE idUzytkownika = '$userId' AND k.id = idKsiazki";
            $result = $conn->query($sql);

            echo "<div class='center-grid-container'>";

            if($result->num_rows > 0) {
                while($row = $result->fetch_object()) {
                    echo "
                        <p>{$row->nazwa} {$row->dataRezerwacji}</p>
                        <img class='book-img' src='imgs/databaseImgs/insertedBooks/" . urlencode($row->obrazek) . "' alt='zdjęcie książki'>
                        <form action='deleteReservation.php' method='post'>
                            <input type='hidden' name='userId' value='{$_SESSION['userId']}'>
                            <input type='hidden' name='bookId' value='{$row->idKsiazki}'>
                            <button type='submit'>Zrezygnuj z rezerwacji</button>
                        </form>
                    ";
                }
            } else {
                echo "<p>Brak zarezerwowanych książek</p>";
            }

            echo "</div>";

            $conn->close();
        ?>
    </main>
    <footer>
        <?php
            require("footer.php");
        ?>
    </footer>
</body>
</html>