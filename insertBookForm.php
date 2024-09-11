<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie książki</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/insertBookForm.css">
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
        <form class="center-grid-container" action="insertBook.php" method="post" enctype="multipart/form-data">
            <p><input type="text" name="name" placeholder="Nazwa książki" required></p>
            <p><input type="text" name="author" placeholder="Autor" required></p>
            <p>Kategoria 
                <select name="categoryId" id="">
                    <?php
                        $sql = "SELECT id, nazwa FROM kategorie";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_object())
                            echo "<option value='{$row->id}'>{$row->nazwa}</option>";
                        $conn->close();
                    ?>
                </select>
            </p>
            <p><input type="number" name="yearOfRelease" placeholder="Rok wydania(Polska)" required></p>
            <textarea name="description" placeholder="Opis" required></textarea>
            <p>Obrazek <input type="file" name="picture" required></p>
            <button type="submit">Dodaj książkę</button>
        </form>
    </main>
    <footer>
        <?php
            require("footer.php");
        ?>
    </footer>
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