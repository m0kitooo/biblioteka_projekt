<form class="footer-form" action="insertReport.php" method="post">
    <textarea class="report-textarea" name="reportContent" placeholder="Jeżeli masz jakiś problem, tutaj jest miejsce na zgłoszenie go do administratoracji"></textarea>
    <?php
        if(isset($_SESSION["login"]))
            echo "<button class='footer-bttn' type='submit'>Wyślij</button>";
        else
            echo "<a href='login.php'><button class='footer-bttn' type='button'>Wyślij</button></a>";
    ?>
</form>
<p class='footer-paragraph'>Strona wykonana przez: Mikołaj Klimuszko</p>