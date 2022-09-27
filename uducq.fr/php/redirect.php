<?php

require("../../conf/config.php");
require("../lib/mysql.php");

$long_url=getLongFromShortURL($_GET['url']);

if (!empty($long_url)) {
    updateURLCounter($_GET['url']);

    header('Location: ' .  $long_url);
    exit;
} else {
    header('HTTP/1.0 404 Not Found');
    echo "<title>404 Not Found</title>
	  </head><body>
	  <h1>Page introuvable</h1>
	  <p>L'URL demandée ".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']." n'existe pas.</p>";
    exit;
}
