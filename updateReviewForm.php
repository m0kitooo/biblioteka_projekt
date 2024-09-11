<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja recenzji</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/updateReviewForm.css">
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
            $reviewId = $_GET["reviewId"];
            $bookId = $_GET["bookId"];

            $sql = "SELECT tresc, ocena FROM recenzje WHERE id = '$reviewId'";
            $result = $conn->query($sql);
            $row = $result->fetch_object();
            echo "
                <div class='centered-container'>
                    <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='1'>
                    <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='2'>
                    <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='3'>
                    <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='4'>
                    <img class='star-img star-interactive' src='imgs/nonDatabaseImgs/star.png' alt='zdjęcie gwiazdki' data-index='5'>
                </div>
                <form class='centered-container' action = 'updateReview.php' method = 'post'>
                    <textarea name='content' placeholder='Dodaj komentarz' required>$row->tresc</textarea>
                    <input type='hidden' id='star-rating' name='rate' value='1'>
                    <input type='hidden' name='reviewId' value='{$reviewId}'>
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
    <script src="js/starsAnimation.js"></script>
</body>
</html>