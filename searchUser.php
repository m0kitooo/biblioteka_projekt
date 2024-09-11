<?php
    $searchInputVal = $_POST["searchInputVal"];
    $bookId = $_POST["bookId"];

    require("db.php");
    $sql = "SELECT id, nick FROM uzytkownicy WHERE nick LIKE '$searchInputVal%'";
    $result = $conn->query($sql);

    $conn->close();

    if($result->num_rows > 0 && $searchInputVal != "") {
        while($row = $result->fetch_object()) {
            // echo "
            //     <p><a>{$row->nick}</a></p>
            // ";
            echo "
                    <form action='insertBookBorrow.php' method='post'>
                        <input type='hidden' name='bookId' value='{$bookId}'>
                        <input type='hidden' name='userId' value='{$row->id}'>
                        <p>{$row->nick} <button type='submit'>Wypożycz</button></p>
                    </form>
                ";
        }
    }
?>