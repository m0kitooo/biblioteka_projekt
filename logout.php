<?php
    session_start();

    unset($_SESSION["userId"]);
    unset($_SESSION["login"]);
    unset($_SESSION["nick"]);
    unset($_SESSION["role"]);

    header("Location: index.php");
?>