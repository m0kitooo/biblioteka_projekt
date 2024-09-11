<?php
    $conn = new mysqli("localhost", "root", "", "biblioteka_projekt");
    if($conn->connect_error)
        exit("Connection failed: " . $conn->connect_error);
?>