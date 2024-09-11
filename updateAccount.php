<?php
    require("db.php");

    $sql = "SELECT login, ";

    session_start();
    $login = $_SESSION["login"];
    $nick = $_POST["nick"];
    $userId = $_SESSION["userId"];

    if(!empty($_FILES["picture"]["name"])) {
        mkdir("imgs/databaseImgs/profilePictures/{$userId}");
        
        $picture = basename($_FILES["picture"]["name"]);
        $targetDirectory = "imgs/databaseImgs/profilePictures/{$userId}";
        $targetPath = $targetDirectory . "/" . $picture;

        $sql = "UPDATE uzytkownicy SET obrazek = '$picture' WHERE id = '$userId'";

        if(getimagesize($_FILES["picture"]["tmp_name"]) !== false) {
            move_uploaded_file($_FILES["picture"]["tmp_name"], $targetPath);
            $conn->query($sql);
        }

        $sql = "UPDATE uzytkownicy SET nick = '$nick' WHERE login = '$login'";
        $conn->query($sql);
    } else {
        // $sql = "UPDATE nick FROM uzytkownicy WHERE nick = $nick";
        $sql = "UPDATE uzytkownicy SET nick = '$nick' WHERE login = '$login'";
        $conn->query($sql);
    }

    $_SESSION["nick"] = $nick;

    $conn->close();
    header("Location: myAccount.php");
    exit;
?>
