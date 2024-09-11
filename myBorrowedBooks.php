<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wypożyczone książki</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/myBorrowedBooks.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
            require("db.php");
        ?>
    </header>
    <main>
        <?php
            $userId = $_SESSION["userId"];
            $sql = "SELECT idKsiazki, idUzytkownika, dataWypozyczenia, k.id, nazwa, obrazek FROM wypozyczenia, ksiazki k WHERE idUzytkownika = '$userId' AND k.id = idKsiazki";
            $result = $conn->query($sql);
            
            echo "<div class='center-grid-container'>";
            
            if($result->num_rows > 0) {
                while($row = $result->fetch_object()) {
                    echo "
                        <p>{$row->nazwa} {$row->dataWypozyczenia}</p>
                        <img class='book-img' src='imgs/databaseImgs/insertedBooks/" . urlencode($row->obrazek) . "' alt='zdjęcie książki'>
                    ";
                }
            } else {
                echo "<p>Brak wypożyczonych książek</p>";
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