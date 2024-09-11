<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja książki</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/updateBookForm.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <?php
            require("db.php");
            require("nav.php");
        ?>
    </header>
    <main>
        <?php
            $bookId = $_GET["bookId"];

            $sql = "SELECT kat.nazwa AS nazwaKategorii, idKategorii, k.nazwa, autor, rokWydania, opis, obrazek, ilosc FROM kategorie kat, ksiazki k WHERE kat.id = idKategorii AND k.id = $bookId";
            $result = $conn->query($sql);

            $row = $result->fetch_object();
                
            echo "
                <form class='center-grid-container' action='updateBook.php' method='post' enctype='multipart/form-data'>
                    <select name='categoryId'>
            ";
            $sql = "SELECT id, nazwa FROM kategorie";
            $result = $conn->query($sql);

            while($row2 = $result->fetch_object()) {
                if($row2->id === $row->idKategorii) {
                    echo "<option value='{$row2->id}' selected>{$row2->nazwa}</option>";
                } else {
                    echo "<option value='{$row2->id}'>{$row2->nazwa}</option>";
                }
            }
            echo "  
                    </select>
                    <input placeholder='Nazwa' name='bookName' value='{$row->nazwa}' required>
                    <p>Poprzedni obrazek:</p>
                    <img class='book-img' src='imgs/databaseImgs/insertedBooks/" . urlencode($row->obrazek) . "' alt='zdjęcie książki'>
                    <input type='file' name='picture'>
                    <input placeholder='Autor' name='author' value='{$row->autor}' required>
                    <input placeholder='Rok wydania' name='releaseYear' value='{$row->rokWydania}' required>
                    <textarea name='description' placeholder='Opis' required>{$row->opis}</textarea>
                    <input name='count' value='{$row->ilosc}' placeholder='Ilość' required>
                    <input type='hidden' name='bookId' value='{$bookId}'>
                    <button type='submit'>Zaktualizuj</button>
                </form>
            ";
        ?>
    </main>
    <footer>
        <?php
            require("footer.php");
        ?>
    </footer>
    <script>
        $(document).ready(function() {
            <?php if (isset($_POST['result'])): ?>
                var result = <?php echo json_encode($_POST['result']); ?>;
                switch(result) {
                    case '1':
                        alert('Plik nie jest obrazkiem');
                        break;
                    case '2':
                        alert('Plik o takiej nazwie już istnieje');
                        break;
                    case '3':
                        alert('Książka została poprawnie zaktualizowana');
                        break;
                    case '4':
                        alert('Wystapił problem z wysłaniem obrazka');
                        break;
                    default:
                        alert('Nieznany wynik operacji');
                }
            <?php endif; ?>
        });
    </script>
</body>
</html>