<?php
    require("db.php");
    $bookId = $_POST["bookId"];

    $categoryId = $_POST["categoryId"];
    $bookName = $_POST["bookName"];
    $author = $_POST["author"];
    $releaseYear = $_POST["releaseYear"];
    $description = $_POST["description"];
    $count = $_POST["count"];

    if(!empty($_FILES["picture"]["name"])) {
        $picture = basename($_FILES["picture"]["name"]);
        $targetDirectory = "imgs/databaseImgs/insertedBooks";
        $targetPath = $targetDirectory . "/" . $picture;

        echo "<form id='redirectForm' method='post' action='insertBookForm.php'>";
        if(getimagesize($_FILES["picture"]["tmp_name"]) === false) {
            echo "<input type='hidden' name='result' value='1'>";
        } elseif(file_exists($targetPath)) {
            echo "<input type='hidden' name='result' value='2'>";
        } elseif(move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath)) {
            $sql = "SELECT obrazek FROM ksiazki WHERE id = '$bookId'";
            $result = $conn->query($sql);
            $row = $result->fetch_object();
            $filePath = "imgs/databaseImgs/insertedBooks/" . $row->obrazek;
            unlink($filePath);

            $sql = "UPDATE ksiazki SET idKategorii = '$categoryId', nazwa = '$bookName', autor = '$author', obrazek = '$picture', rokWydania = '$releaseYear', opis = '$description', ilosc = '$count' WHERE id = '$bookId'";
            $conn->query($sql);
            echo "<input type='hidden' name='result' value='3'>";  
        } else {
            echo "<input type='hidden' name='result' value='4'>";
        }
        echo "</form>";  
    } else {
        $sql = "UPDATE ksiazki SET idKategorii = '$categoryId', nazwa = '$bookName', autor = '$author', rokWydania = '$releaseYear', opis = '$description', ilosc = '$count' WHERE id = '$bookId'";
        $conn->query($sql);
    }

    $conn->close();

    header("Location: details.php?bookId={$bookId}");
?>