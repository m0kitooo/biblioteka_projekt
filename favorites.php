<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulubione</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/favorites.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <?php
        echo "<header>";
        require("nav.php");
        echo "</header>";

        $userId = $_SESSION["userId"];
        
        $sql = "SELECT k.id, k.nazwa, k.obrazek FROM ksiazki k, ulubione u WHERE u.idKsiazki = k.id AND idUzytkownika = $userId";
        require("db.php");
        $result = $conn->query($sql);

        echo "<main>";
        if($result->num_rows > 0) {
            echo "<table>";
                // <tr>
                //     <th>Nazwa</th>
                //     <th>Obrazek</th>
                // </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td><a href='details.php?bookId=" . $row["id"] . "'>" . $row["nazwa"] . "</a></td>
                    <td><img class='book-img' src='imgs/databaseImgs/insertedBooks/".urlencode($row["obrazek"])."' alt='zdjęcie książki'></td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "Brak polubionych książek";
        }
        echo "</main>";

        $conn->close();

        echo "<footer>";
        require("footer.php");
        echo "</footer>";
    ?>
</body>
</html>
