<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje konto</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/myAccount.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
    <header>
        <?php require("nav.php"); ?>
    </header>
    <main class="grid-container">
            <?php
                require("db.php");
                $userId = $_SESSION["userId"];
                $nick = $_SESSION["nick"];
                
                $sql = "SELECT email, obrazek FROM uzytkownicy WHERE id = $userId";
                $result = $conn->query($sql);
                $row = $result->fetch_object();
                $picture = $row->obrazek;
                
                if($picture === "") {
                    echo "<img class='profile-picture-img' src='imgs/nonDatabaseImgs/deafultpp.png' alt='zdjęcie użytkownika'>";
                } else
                    echo "<img class='profile-picture-img' src='imgs/databaseImgs/profilePictures/{$userId}/{$picture}' alt='zdjęcie użytkownika'>";
                
                echo "
                    <form action='updateAccount.php' method='post' enctype='multipart/form-data'>
                        <input class='input-file-button' type='file' name='picture'></input>
                        <p id='login-paragraph'>{$nick}</p>
                        <input class='nick-input' id='login-input' type='text' name='nick' value='{$nick}' placeholder='Nowy nick'></input>
                        <button type='button' id='edit-button'>Edytuj</button>
                        <p>{$row->email}</p>
                        <button type='submit'>Zapisz zmiany</button>
                    </form>
                ";
            ?>
    </main>
    <footer>
        <?php require("footer.php");?>
    </footer>

    <script>
        $(document).ready(function() {
            // $('#login-paragraph').style.display = "none";
            $('#login-input').css('display', 'none');


            $('#edit-button').click(function() {
                let $paragraph = $('#login-paragraph');
                let $inputField = $('#login-input');

                if ($paragraph.is(':visible')) {
                    $inputField.val($paragraph.text()).show();
                    $paragraph.hide();
                    $(this).text('Ok'); 
                } else {
                    let updatedValue = $inputField.val();
                    $paragraph.text(updatedValue).show();
                    $inputField.hide();
                    $(this).text('Edytuj');
                    
                    // Optional: AJAX request to save the updated value
                    // $.post('updateDescription.php', { description: updatedValue }, function(response) {
                    //     alert(response); // Optionally handle response
                    // });
                }
            });
        });
    </script>
</body>
</html>