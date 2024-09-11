<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/categories.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
        ?>
    </header>
    <main class="center-grid-container">
        <form action="insertCategory.php" method="post">
            <input class="insert-category-input" type="text" name="categoryName" placeholder="Nazwa kategorii" required>
            <button type="submit">Dodaj kategorie</button>
        </form>
        <?php
            require("db.php");

            $sql = "SELECT * FROM kategorie";
            $result = $conn->query($sql);
            $conn->close();
            while($row = $result->fetch_object()) {
                echo "
                    <form action='updateCategory.php' method='post'>
                        <input type='hidden' name='categoryId' value='{$row->id}'>
                        <input name='categoryName' value='{$row->nazwa}' placeholder='Nazwa kategorii'>
                        <button type='submit'>Edytuj</button>
                    </form>
                    <form action='deleteCategory.php' method='post'>
                        <input type='hidden' name='categoryId' value='{$row->id}'>
                        <button type='submit'>Usuń</button>
                    </form>
                    <br>
                ";
            }
        ?>
    </main>
    <footer>
        <?php
            require("footer.php");
        ?>
    </footer>
</body>
</html>