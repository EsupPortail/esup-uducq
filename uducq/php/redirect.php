<?php

require("inc/header.php");

$long_url=getLongFromShortURL($_GET['url']);

if (!empty($long_url)) {
    updateURLCounter($_GET['url']);

    header('Location: ' .  $long_url);
    exit;
} else {
    echo "<h2>Cette redirection n'existe pas</h2>";
    echo "<br /><center><img src='/media/images/grumpycat.jpg' width='400px'/></center><br />";
}
