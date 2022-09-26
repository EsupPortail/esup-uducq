<?php

#Ce code positionne le code de retour http des liens de u2l dans la colonne last_http_respcode.

include("conf/config.php");
include("lib/mysql.php");

#Connexion MySQL
$db=mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
if (!mysqlConnect($DB_BASE)) {
    echo "probleme de connexion mysql";
}

function code_retour_url($url)
{
    #le @ sert à masquer les erreurs qui bloquent le reste
    $retour = @get_headers($url);
    if ($retour) {
        return substr($retour[0], 9, 3);
    } else {
        return "404";
    }
}

ini_set('user_agent', 'Mozilla/5.0');

$_urls=getAllURL();
foreach ($_urls as $url) {
    $sql = 'UPDATE urls SET last_http_respcode="'.code_retour_url($url['long_url']).'" WHERE id="'.$url['id'].'"';
    mysqli_query($db, $sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}
