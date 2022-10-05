<?php

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

#Contrôle si l'utilisateur a accès à l'application et quels droits il a
function droitsAppli($user)
{
    global $db;
    $sql_nb = 'SELECT count(*) as nb FROM users WHERE uid="'.$user.'"';
    $req_nb = mysqli_query($db, $sql_nb) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat_nb = mysqli_fetch_assoc($req_nb);
    if ($resultat_nb['nb'] == 0) {
        return false;
    }
    return true;
}

#Voir les permissions de l'utilisateur
function getPermissions($user)
{
    global $db;
    $sql = 'SELECT privilege FROM users WHERE uid="'.$user.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat = mysqli_fetch_assoc($req);
    if (isset($resultat)) {
        return $resultat['privilege'];
    } else {
        #pas trouvé dans la DB, donc permission 0
        return "0";
    }
}

#Tableau des utilisateurs de l'application
function listeUsersAppli($userPermission, $privilege)
{
    global $db;
    #$userPermission : droits de l'utilisateur qui affiche la liste
    #$privilege : on affiche les users avec tel privilège uniquement
    $sql = 'SELECT uid,privilege FROM users WHERE privilege ="'.$privilege.'" ORDER BY uid ASC';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());

    echo "<center><table class='table-borderless'>";
    while ($data = mysqli_fetch_assoc($req)) {
        if ($userPermission==3) {
            #Admin, donc droits de modifs
            echo '<tr><td>'.$data['uid'].'</td><td><table class="table-borderless"><tr><td>'.formModuserAppli($data['uid'], 'U').'</td><td>'.formModuserAppli($data['uid'], 'G').'</td><td>'.formModuserAppli($data['uid'], 'A').'</td></tr></table><td>'.formDeluserAppli($data['uid']).'</td></tr>';
        } elseif ($userPermission==2) {
            #Gestionnaire donc droits de modifs visualisateur/utilisateur
            if ($privilege<=1) {
                #Ne peut modifier que les visualisateurs et les utilisateurs
                echo '<tr><td>'.$data['uid'].'</td><td><table class="table-borderless"><tr><td>'.formModuserAppli($data['uid'], 'U').'</td></tr></table></tr>';
            } else {
                echo '<tr><td>'.$data['uid'].'</td></tr>';
            }
        } else {
            echo '<tr><td>'.$data['uid'].'</td></tr>';
        }
    }
    echo "</table></center>";
}

#Gestion des utilisateurs de l'appli (permissions)

#Ajoute un utilisateur à l'appli
function addUserAppli($user, $privilege)
{
    global $db;
    $sql = 'INSERT INTO users (uid,privilege) VALUES ("'.$user.'","'.$privilege.'")';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    addLog("Ajout du compte applicatif $user");
}

#Supprime un utilisateur de l'appli
function delUserAppli($user)
{
    global $db;
    $sql = 'DELETE FROM users WHERE uid="'.$user.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    addLog("Suppression du compte applicatif $user");
}

#Modifie les privilèges d'un utilisateur
function modUserAppli($user, $privilege)
{
    global $db;
    $sql = 'UPDATE users SET privilege="'.$privilege.'" WHERE uid="'.$user.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    addLog("Modification des droits du compte applicatif $user (passage en $privilege)");
}

#Check si un utilisateur est présent ou pas (true si déjà présent)
function checkUserAppli($user)
{
    global $db;
    $sql_nb = 'SELECT count(*) as nb FROM users WHERE uid="'.$user.'"';
    $req_nb = mysqli_query($db, $sql_nb) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat_nb = mysqli_fetch_assoc($req_nb);
    if ($resultat_nb['nb'] == 0) {
        return false;
    }
    return true;
}

function genereShortURL($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function addURL($long, $short)
{
    global $db;
    $date=date('Y-m-d');
    $sql = 'INSERT INTO urls (long_url,short_code,date_created,creator_uid) VALUES ("'.$long.'","'.$short.'","'.$date.'","'.$_SESSION['cas_user'].'")';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    addLog("Ajout de l'URL $short ($long)");
}

function modURL($id, $long, $short)
{
    global $db;
    $sql = 'UPDATE urls SET long_url="'.$long.'",short_code="'.$short.'" WHERE id="'.$id.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    addLog("Modification de l'URL d'id $id en $short ($long)");
}

function delURL($id_url)
{
    global $db;
    $infos=getInfosFromidURL($id_url);

    $sql = 'DELETE FROM urls WHERE id="'.$id_url.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    addLog("Suppression de l'URL ".$infos['short_code']." (".$infos['long_url'].")");
}

function isShortURLExist($shorturl)
{
    global $db;
    $shorturl=mysqli_real_escape_string($db, $shorturl);
    $sql = 'SELECT count(*) as nb FROM urls WHERE short_code="'.$shorturl.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat_nb = mysqli_fetch_assoc($req);
    if ($resultat_nb['nb'] == 0) {
        return false;
    }
    return true;
}

function isLongURLExist($longurl)
{
    global $db;
    $sql = 'SELECT count(*) as nb FROM urls WHERE long_url="'.$longurl.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat_nb = mysqli_fetch_assoc($req);
    if ($resultat_nb['nb'] == 0) {
        return false;
    }
    return true;
}

function getShortFromLongURL($longurl)
{
    global $db;
    $shorturl=mysqli_real_escape_string($db, $longurl);

    $sql = 'SELECT short_code FROM urls WHERE long_url="'.$longurl.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat = mysqli_fetch_assoc($req);
    return $resultat['short_code'];
}

function getAllURL()
{
    global $db;
    $sql = 'SELECT * FROM urls';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $i=0;
    while ($data = mysqli_fetch_assoc($req)) {
        $rslt[$i]= $data;
        $i++;
    }
    if (!empty($rslt)) {
        return $rslt;
    }
}

function getInfosFromidURL($id)
{
    global $db;
    $sql = 'SELECT * FROM urls WHERE id="'.$id.'"';
    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    $resultat = mysqli_fetch_assoc($req);
    return $resultat;
}

# Fonctions présentes dans uducq.fr/php/redirect.php pour la prod
if ($_INSTANCE=="test") {
    function getLongFromShortURL($shorturl)
    {
        global $db;
        $shorturl=mysqli_real_escape_string($db, $shorturl);

        $sql = 'SELECT long_url FROM urls WHERE short_code="'.$shorturl.'"';
        $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
        $resultat = mysqli_fetch_assoc($req);
        return $resultat['long_url'];
    }

    function updateURLCounter($shorturl)
    {
        global $db;
        $shorturl=mysqli_real_escape_string($db, $shorturl);
        $sql = 'UPDATE urls SET counter=counter+1 WHERE short_code="'.$shorturl.'"';
        $req = mysqli_query($db, $sql) or die('Erreur SQL !<br/>'.$sql.'<br/>'.mysqli_error());
    }
}
