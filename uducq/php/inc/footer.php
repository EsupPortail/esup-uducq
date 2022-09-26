<footer class="footer">
	<p class="float-left">Fait avec &#9825; par la <a href='mailto:<?php echo $_MAIL_CONTACT; ?>'>Direction du Numérique</a>.</p>
	<?php
    echo "<p class='float-right text-right'>Connecté en tant que ".$_SESSION['cas_user']." <br /> <a href='logout.php'>Déconnexion</a></p>";

    // on ferme la connexion à mysql
    global $db;
    mysqli_close($db);
    ?>
</footer>
</div>

</body>
</html>
