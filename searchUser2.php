<?php
    $searchInputVal = $_POST["searchInputVal"];

    require("db.php");
    $sql = "SELECT id, nick FROM uzytkownicy WHERE nick LIKE '$searchInputVal%'";
    $result = $conn->query($sql);

    $conn->close();

    if($result->num_rows > 0 && $searchInputVal != "") {
        while($row = $result->fetch_object()) {
            echo "
                <a href='userBookStatus.php?userId=$row->id'><p>{$row->nick}</p></a>
            ";
        }
    }
?>