<?php

require("../conf/config.php");

#Connexion MySQL
function mysqlConnect($base)
{
    global $db;
    if (($db)&&(mysqli_select_db($db, $base))) {
        return true;
    } else {
        return false;
    }
}

#Connexion MySQL
$db=mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
if (!mysqlConnect($DB_BASE)) {
    echo "probleme de connexion mysql";
}

function updateURLCounter($shorturl)
{
    global $db;
    $sql = 'UPDATE urls SET counter=counter+1 WHERE short_code="'.$shorturl.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysql_error());
}

function getLongFromShortURL($shorturl)
{
    global $db;
    $shorturl=mysqli_real_escape_string($db, $shorturl);

    $sql = 'SELECT long_url FROM urls WHERE short_code="'.$shorturl.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysql_error());
    $resultat = mysqli_fetch_assoc($req);
    return $resultat['long_url'];
}
