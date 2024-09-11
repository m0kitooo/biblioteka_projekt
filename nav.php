<?php
    session_start();
    $current_page = basename($_SERVER['PHP_SELF']); // Extracts 'filename.php' from the current URL
?>
<div class="img-background">
    <a class="website-name" href="index.php">
        <!-- <img src="imgs/nonDatabaseImgs/open-book.png" alt=""> -->
        <h1>Bibliotekowo</h1>
    </a>
</div>
<nav>
    <ul>
        <li class="<?= ($current_page == 'index.php') ? 'active' : '' ?>"><a href="index.php">Strona główna</a></li>
        <?php if(isset($_SESSION["login"])): ?>
            <li class="<?= ($current_page == 'favorites.php') ? 'active' : '' ?>"><a href='favorites.php'>Ulubione</a></li>
            <li class="<?= ($current_page == 'myReservations.php') ? 'active' : '' ?>"><a href='myReservations.php'>Moje rezerwacje</a></li>
            <li class="<?= ($current_page == 'myBorrowedBooks.php') ? 'active' : '' ?>"><a href='myBorrowedBooks.php'>Moje wypożyczenia</a></li>
        <?php else: ?>
            <li class="<?= ($current_page == 'login.php') ? 'active' : '' ?>"><a href='login.php'>Ulubione</a></li>
            <li class="<?= ($current_page == 'login.php') ? 'active' : '' ?>"><a href='login.php'>Moje rezerwacje</a></li>
            <li class="<?= ($current_page == 'login.php') ? 'active' : '' ?>"><a href='login.php'>Moje wypożyczenia</a></li>
        <?php endif; ?>

        <?php if(isset($_SESSION["role"]) && $_SESSION["role"] !== "user"): ?>
            <li class="<?= ($current_page == 'insertBookForm.php') ? 'active' : '' ?>"><a href='insertBookForm.php'>Dodaj książkę</a></li>
            <li class="<?= ($current_page == 'categories.php') ? 'active' : '' ?>"><a href='categories.php'>Kategorie</a></li>
            <li class="<?= ($current_page == 'bookStatus.php') ? 'active' : '' ?>"><a href='bookStatus.php'>Status książek</a></li>
            <li class="<?= ($current_page == 'reports.php') ? 'active' : '' ?>"><a href='reports.php'>Zgłoszenia</a></li>
        <?php endif; ?>

        <?php if(!isset($_SESSION["login"])): ?>
            <li class="<?= ($current_page == 'login.php') ? 'active' : '' ?>"><a href='login.php'>Zaloguj się</a></li>
        <?php else: ?>
            <li class="<?= ($current_page == 'logout.php') ? 'active' : '' ?>"><a href='logout.php'>Wyloguj się</a></li>
        <?php endif; ?>

        <li class="<?= ($current_page == 'registration.php') ? 'active' : '' ?>"><a href="registration.php">Zarejestruj się</a></li>

        <?php if($nick = $_SESSION["nick"] ?? false): ?>
            <li class="<?= ($current_page == 'myAccount.php') ? 'active' : '' ?>"><a href='myAccount.php'>Moje konto</a></li>
            <li><?= htmlspecialchars($nick) ?></li>
        <?php endif; ?>
    </ul>
</nav>
