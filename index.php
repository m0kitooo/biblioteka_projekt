<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
            require("db.php");
        
            $selectedCategory = (!isset($_GET["categoryId"])) ? 'selected-category' : '';
            echo "
                <ul class='centered-container non-list-style'>
                    <li><a href='index.php' class='{$selectedCategory} category-styling'>Wszystkie</a></li>
            ";
            
            $sql = "SELECT id, nazwa FROM kategorie";
            $result = $conn->query($sql);
            while($row = $result->fetch_object()) {
                $categoryId = (isset($_GET["categoryId"])) ? $_GET["categoryId"] : '';
                $selectedCategory = ($categoryId === $row->id) ? 'selected-category' : '';
                echo "<li><a href='index.php?categoryId={$row->id}' class='{$selectedCategory} category-styling'>{$row->nazwa}</a></li>";
            }
            echo "</ul>";
        ?>

        <div class="centered-container">
            <form class="search-form" action="">
                <?php
                    if(isset($_GET["categoryId"])) {
                        $categoryId = $_GET["categoryId"];
                        echo "<input type='hidden' name='categoryId' value='{$categoryId}'>";
                    }
                ?>
                <input id="search-input" class="search-input" autocomplete="off" placeholder="Szukaj" type="text" name="phrase" value="<?= isset($_GET['phrase']) ? htmlspecialchars($_GET['phrase']) : ''; ?>">
                <button class='search-button' type="submit">Wyszukaj</button>
                <div id="dynamic-search-results-container" class="dynamic-search-results-container"></div>
            </form>
        </div>
    </header>
    <main>
        <?php
            $sql = "SELECT id, nazwa, obrazek, ilosc FROM ksiazki";

            if(isset($_GET["phrase"]) && isset($_GET["categoryId"])) {
                $categoryId = $_GET["categoryId"];
                $phrase = $_GET["phrase"];
                $sql .= " WHERE idKategorii = $categoryId AND nazwa LIKE '%$phrase%'";
            } elseif(isset($_GET["categoryId"])){
                $categoryId = $_GET["categoryId"];
                $sql .= " WHERE idKategorii = $categoryId";
            } elseif(isset($_GET["phrase"])) {
                $phrase = $_GET["phrase"];
                $sql .= " WHERE nazwa LIKE '%$phrase%'";
            }

            $result = $conn->query($sql);
            
            echo "<div class='grid-container'>";
            while($row = $result->fetch_object()) {
                echo "
                    <div class='book-container'>
                        <span class='second-book-container'>
                            <img src='imgs/databaseImgs/insertedBooks/" . urlencode($row->obrazek) . "' alt='zdjęcie książki' class='book-img'>
                            <a href='details.php?bookId=" . $row->id . "' class='book-name'>{$row->nazwa}</a>
                ";
                if(isset($_SESSION["role"]) && $_SESSION["role"] !== "user" ) {
                    if($row->ilosc > 0) {
                        echo "
                            <a href='borrowBook.php?bookId={$row->id}'>Wypożycz książkę</a>
                        ";
                    } else {
                        echo "<p class='zero-count-paragraph'>0 sztuk, nie można wypożyczyć</p>";
                    }
                }
                echo "      <form action='deleteBook.php' method='post'>
                                <input type='hidden' name='bookId' value='" . $row->id . "'>
                                <button type='submit'>Usuń</button>
                            </form>    
                        </span>
                    </div>
                ";
            }
            echo "<div/>";
        ?>
    </main>
    <footer>
        <?php
            $conn->close();
            require("footer.php");
        ?>
    </footer>
    <script src="js/searchBook.js"></script>
</body>
</html>