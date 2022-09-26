<?php

#error_reporting(E_ALL);

include("../conf/config.php");
include("../lib/mysql.php");
include("../lib/formulaires.php");
include("../lib/Utils.php");

if ($_SERVER['PHP_SELF']!='/redirect.php') {
    #Connexion CAS
    include_once('phpCAS/CAS.php');
    phpCAS::client(CAS_VERSION_2_0, $_URL_CAS, 443, '');
    phpCAS::handleLogoutRequests(true, $_URL_CAS);
    phpCAS::setNoCasServerValidation();
    phpCAS::forceAuthentication();
    $_SESSION['cas_user'] = phpCAS::getUser();
} else {
    $_SESSION['cas_user'] = "debal";
}

#Connexion MySQL
$db=mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
if (!mysqlConnect($DB_BASE)) {
    echo "probleme de connexion mysql";
    exit(1);
}

#Voir les permissions de l'utilisateur (0, 1, 2 ou 3)
$userPermission = getPermissions($_SESSION['cas_user']);
