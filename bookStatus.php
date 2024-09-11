<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
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
        <div class="centered-container">
            <form class="search-form" action="">
                <input id="search-input" class="search-input" autocomplete="off" placeholder="Szukaj" type="text" name="phrase" value="<?= isset($_GET['phrase']) ? htmlspecialchars($_GET['phrase']) : ''; ?>">
                <button class='search-button' type="submit">Wyszukaj</button>
                <div id="dynamic-search-results-container" class="dynamic-search-results-container"></div>
            </form>
        </div>
         
        <?php
            $sql = "SELECT id, nick FROM uzytkownicy";

            if(isset($_GET["phrase"])) {
                $phrase = $_GET["phrase"];
                $sql .= " WHERE nick LIKE '%$phrase%'";
            }
            $result = $conn->query($sql);
            while($row = $result->fetch_object()) {
                echo "
                    <div class='centered-container'>
                        <a href='userBookStatus.php?userId=$row->id'><p>{$row->nick}</p></a>
                    </div>
                ";
            }
            $conn->close();
        ?>
    </main>
    <footer>
        <?php
            require("footer.php");
        ?>
    </footer>
    <script src='js/searchUser2.js'></script>
</body>
</html>