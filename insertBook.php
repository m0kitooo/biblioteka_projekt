<?php
    require("db.php");

    $name = $_POST["name"];
    $author = $_POST["author"];
    $categoryId = $_POST["categoryId"];
    $yearOfRelease = $_POST["yearOfRelease"];
    $description = $_POST["description"];
    
    $picture = basename($_FILES["picture"]["name"]);
    $targetDirectory = "imgs/databaseImgs/insertedBooks";
    $targetPath = $targetDirectory . "/" . $picture;

    $sql = "INSERT INTO ksiazki (idKategorii, nazwa, autor, rokWydania, opis, obrazek) VALUES ('$categoryId', '$name', '$author', '$yearOfRelease', '$description', '$picture')";
    echo "<form id='redirectForm' method='POST' action='insertBookForm.php'>";
    
    if(getimagesize($_FILES["picture"]["tmp_name"]) === false) {
        echo "<input type='hidden' name='result' value='Plik nie jest obrazkiem'>";
    } elseif(file_exists($targetPath)) {
        echo "<input type='hidden' name='result' value='Plik o takiej nazwie już istnieje'>";
    } elseif(move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath) && $conn->query($sql)) {
        echo "<input type='hidden' name='result' value='Książka została poprawnie dodana'>";  
    } else {
        echo "<input type='hidden' name='result' value='Wystapił problem z wysłaniem obrazka'>";
    }

    echo "</form>";
    $conn->close();
?>
<script>
    document.getElementById('redirectForm').submit();
</script>