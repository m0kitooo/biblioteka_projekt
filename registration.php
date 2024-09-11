<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracja</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
    require("db.php");
    if (isset($_POST["login"])) {
        $login = $_POST["login"];
        $nick = $_POST["nick"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql1 = "SELECT login FROM uzytkownicy WHERE login = '$login' LIMIT 1";
        $sql2 = "SELECT nick FROM uzytkownicy WHERE nick = '$nick' LIMIT 1";
        $sql3 = "SELECT email FROM uzytkownicy WHERE email = '$email' LIMIT 1";
        $sql4 = "INSERT INTO uzytkownicy (login, nick, haslo, email) VALUES ('$login', '$nick', '" . md5($password) . "', '$email')";
        
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);

        if($result1->num_rows > 0) {
            echo "
                <div class='form'>
                    <h3>Użytkownik o takim loginie już istnieje.</h3><br/>
                    <p class='link'><a href='registration.php'>Kliknij tutaj, aby ponowić próbę rejestracji.</a></p>
                </div>
            ";
        } elseif($result2->num_rows > 0) {
            echo "
                <div class='form'>
                    <h3>Użytkownik o takim nick-u już istnieje.</h3><br/>
                    <p class='link'><a href='registration.php'>Kliknij tutaj, aby ponowić próbę rejestracji.</a></p>
                </div>
            ";
        } elseif($result2->num_rows > 0) {
            echo "
                <div class='form'>
                    <h3>Użytkownik o takim email-u już istnieje.</h3><br/>
                    <p class='link'><a href='registration.php'>Kliknij tutaj, aby ponowić próbę rejestracji.</a></p>
                </div>
            ";
        } elseif($result4 = $conn->query($sql4)) {
            $sql = "SELECT id, rola FROM uzytkownicy WHERE login = '$login'";
            $result = $conn->query($sql);
            
            if($result) {
                if ($row = $result->fetch_object()) {
                    session_start();
                    $_SESSION["userId"] = $row->id;
                    $_SESSION["login"] = $login;
                    $_SESSION["nick"] = $nick;
                    $_SESSION["role"] = $row->rola;
                }                
                
                echo "
                    <div class='form'>
                        <h3>Zostałeś pomyślnie zarejestrowany.</h3><br/>
                        <a href='index.php'><button>Ok</button></a>
                    </div>
                ";    
            }
        } 
    } else {
    ?>
        <form class="form" action="" method="post">
            <h1 class="login-title">Rejestracja</h1>
            <input type="text" class="login-input" name="login" placeholder="Login" maxlength="50" required>
            <input type="text" class="login-input" name="nick" placeholder="Nick" maxlength="50" required>
            <input type="text" class="login-input" name="email" placeholder="Email" maxlength="320" required>
            <input type="password" class="login-input" name="password" placeholder="Hasło" maxlength="50" required>
            <button type="submit" class="login-button">Zarejestruj się</button>
            <p class="link"><a href="login.php">Zaloguj się</a></p>
        </form>
    <?php
        }
        $conn->close();
    ?>
</body>
</html>