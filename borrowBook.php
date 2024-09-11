<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/borrowBook.css">
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
            $bookId = $_GET["bookId"];

            $sql = "SELECT nazwa, obrazek FROM ksiazki WHERE id = $bookId";
            $result = $conn->query($sql);
            $row = $result->fetch_object();

            echo "
                <div class='center-grid-container'>
                    <img class='book-img' src='imgs/databaseImgs/insertedBooks/" . urlencode($row->obrazek) . "' alt='zdjęcie książki'>
                    <p>Książka do wypożyczenia: {$row->nazwa}</p>
                </div>
                <div class='centered-container'>
                    <form action='' class='search-form'>
                        <input type='hidden' name='bookId' value='{$bookId}'>
                        <input type='text' id='search-input' class='search-input' name='phrase' autocomplete='off' placeholder='Wpisz nazwę użytkownika'>
                        <button class='search-button'>Wyszukaj</button>
                        <div id='dynamic-search-results-container' class='dynamic-search-results-container'></div>
                    </form>
                </div>
            ";

            $sql = "SELECT id, nick FROM uzytkownicy";

            if(isset($_GET["phrase"])) {
                $phrase = $_GET["phrase"];
                $sql .= " WHERE nick LIKE '%$phrase%'";
            }

            $result = $conn->query($sql);

            echo "<div class='center-grid-container'>";

            while($row = $result->fetch_object()) {
                echo "
                    <form action='insertBookBorrow.php' method='post'>
                        <input id='book-id-input' type='hidden' name='bookId' value='{$bookId}'>
                        <input type='hidden' name='userId' value='{$row->id}'>
                        <p>{$row->nick} <button type='submit'>Wypożycz</button></p>
                    </form>
                ";
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
    <script src="js/searchUser.js"></script>
</body>
</html>