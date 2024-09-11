<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoszenia</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php
            require("nav.php");
            require("db.php")
        ?>
    </header>
    <main>
        <div class='centered-container'>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>id użytkownika</th>
                        <th>treść</th>
                        <th>data wysłania</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT id, idUzytkownika, tresc, dataWyslania FROM zgloszenia";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_object()) {
                            echo "
                                <tr>
                                    <td>{$row->id}</td>
                                    <td>{$row->idUzytkownika}</td>
                                    <td>{$row->tresc}</td>
                                    <td>{$row->dataWyslania}</td>
                                </tr>
                            ";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <?php 
            require("footer.php");
        ?>
    </footer>
</body>
</html>