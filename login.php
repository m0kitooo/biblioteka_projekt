<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
        require('db.php');
        session_start();
        if(isset($_POST["login"])) {
            $login = $_POST["login"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='" . md5($password) . "'";

            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $user = $result->fetch_object();    //trzeba tak zrobic bo jest jakis problem ze wskaznikem ktory wskazuje na zly element kiedy fetch_object wywolane wiecej niz raz

                $_SESSION["userId"] = $user->id;
                $_SESSION["login"] = $login;
                $_SESSION["nick"] = $user->nick;
                $_SESSION["role"] = $user->rola;
                
                $conn->close();
                header("Location: index.php");
                exit;
            } else {
                echo "
                    <div class='form'>
                        <h3>Nieprawidłowy login lub hasło.</h3><br/>
                        <p class='link'>Ponów próbę <a href='login.php'>logowania</a>.</p>
                    </div>
                ";
            }
        } else {
    ?>
        <form class="form" method="post" name="login">
            <h1 class="login-title">Logowanie</h1>
            <input type="text" class="login-input" name="login" placeholder="Login" autofocus="true" required/>
            <input type="password" class="login-input" name="password" placeholder="Hasło" required/>
            <button type="submit" class="login-button">Zaloguj</button>
            <p class="link"><a href="registration.php">Zarejestruj się</a></p>
        </form>
    <?php
        }
        $conn->close();
    ?>
</body>
</html>