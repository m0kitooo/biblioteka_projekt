<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacje o książce</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/details.css">
     <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
            require("db.php");
        ?>
    </header>
    <main class="center-grid-container">
        <?php
            $bookId = $_GET["bookId"];

            $sql = "SELECT kat.nazwa AS nazwaKategorii, idKategorii, k.nazwa, autor, rokWydania, opis, obrazek FROM kategorie kat, ksiazki k WHERE kat.id = idKategorii AND k.id = $bookId";
            $result = $conn->query($sql);

            $row = $result->fetch_object();
                
            echo "
                <a href='index.php?categoryId=" . $row->idKategorii . "'>$row->nazwaKategorii</a>
                <h2>$row->nazwa</h2>
                <img class='book-img' src='imgs/databaseImgs/insertedBooks/" . urlencode($row->obrazek) . "' alt='zdjęcie książki'>
                <p>Autor: $row->autor</p>
                <p>Rok wydania: $row->rokWydania</p>
                <p>$row->opis</p>
            ";
            
            $sql = "SELECT ilosc FROM ksiazki WHERE id = $bookId";
            $result = $conn->query($sql);
            $row = $result->fetch_object();

            if(isset($_SESSION["userId"])) {
                $userId = $_SESSION["userId"];
                $sql = "SELECT id FROM ulubione WHERE idKsiazki = $bookId AND idUzytkownika = $userId";
                $result = $conn->query($sql)->num_rows > 0;
                $img = $result ? 
                    "<img class='heart fav' data-book-id='$bookId' src='imgs/nonDatabaseImgs/heart_full.png'>" :
                    "<img class='heart fav' data-book-id='$bookId' src='imgs/nonDatabaseImgs/heart.png'>";
                
                echo "
                    <p>{$img}</p>
                ";
                if($row->ilosc > 0) {
                    echo "
                        <p>Dostępna ilość: {$row->ilosc}</p>
                        <a href='insertBookReservation.php?bookId={$bookId}'>Zarezerwuj książkę</a>
                    ";
                } else {
                    echo "<p class='zero-count-paragraph'>0 sztuk, nie można zarezerwować</p>";
                }
                if(isset($_SESSION["role"]) && $_SESSION["role"] !== "user" ) {
                    echo "
                        <a href='updateBookForm.php?bookId={$bookId}'>Edytuj informacje o książcę</a>
                    ";
                }
                echo "
                    <div>
                        <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='1'>
                        <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='2'>
                        <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='3'>
                        <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='4'>
                        <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='5'>
                    </div>
                    <form action='insertReview.php' method='post'>
                        <input type='hidden' name='bookId' value='{$bookId}'></input>
                        <input type='hidden' id='star-rating' name='star-rating' value='1'>
                        <textarea name='description-review' placeholder='Dodaj komentarz'></textarea>
                        <button type='submit'>Wyślij</button>
                    </form>
                ";          
            } else {
                echo "
                    <a href='login.php'><img class='heart' src='imgs/nonDatabaseImgs/heart.png'></a>
                ";
                if($row->ilosc > 0) {
                    echo "
                        <p>Dostępna ilość: {$row->ilosc}</p>
                        <a href='login.php'>Zarezerwuj książkę</a>
                    ";
                } else {
                    echo "<p class='zero-count-paragraph'>0 sztuk, nie można zarezerwować</p>";
                }
                echo "
                    <textarea placeholder='Dodaj komentarz'></textarea>
                    <a href='login.php'><button type='button'>Wyślij</button></a>
                ";
            }

            $sql = "SELECT nick, r.id, idUzytkownika, idKsiazki ,ocena, tresc, dataZamieszczenia FROM uzytkownicy u, recenzje r WHERE idUzytkownika = u.id AND idKsiazki = $bookId";
            $result = $conn->query($sql);

            while($row = $result->fetch_object()) {
                echo "
                    <p>{$row->nick} {$row->dataZamieszczenia}</p>          
                    <div>
                ";
                for($i = 0; $i < $row->ocena; $i++) {
                    echo "
                        <img class='star-img' src='imgs/nonDatabaseImgs/star_full.png' alt='zdjęcie gwiazdki'>
                    ";
                }   
                for($i = 0; $i < 5 - $row->ocena; $i++) {
                    echo "
                        <img class='star-img' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki'>
                    ";
                }
                echo "
                    </div>    
                    <p class='review-content-paragraph'>{$row->tresc}</p>          
                ";
                if(isset($_SESSION["userId"]) && $_SESSION["userId"] === $row->idUzytkownika) {
                    echo "
                        <a href='updateReviewForm.php?reviewId={$row->id}&bookId={$bookId}'>Edytuj</a>
                    ";
                }
                if ((isset($_SESSION["role"]) && $_SESSION["role"] === "admin") || 
                    (isset($_SESSION["userId"]) && $_SESSION["userId"] === $row->idUzytkownika)) {
                    echo "
                        <form action='deleteReview.php' method='post'>    
                            <input type='hidden' name='bookId' value='$bookId'>
                            <input type='hidden' name='reviewId' value='$row->id'>
                            <button type='submit'>Usuń</button>
                        </form>
                    ";
                }
                echo "<hr>";
            }
        ?>
    </main>
    <footer>
        <?php
            $conn->close();
            require("footer.php");
            // print_r($_SESSION);
        ?>
    </footer>
    <script src="js/changeFav.js"></script>
    <!-- <script src="js/editReview.js"></script> -->
    <script src="js/starsAnimation.js"></script>
    <script>
        window.onload = function() {
            <?php if (isset($_POST['result'])): ?>
                var result = <?php echo json_encode($_POST['result']); ?>;
                alert(result);
            <?php endif; ?>
        };
    </script>
</body>
</html>