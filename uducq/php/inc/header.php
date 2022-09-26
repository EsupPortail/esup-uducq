<?php
// Execution script init
include("init.php");
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Réducteur d'URL</title>
  <link href="media/css/bootstrap.css" rel="stylesheet">
  <link href="media/css/theme.css" rel="stylesheet">
  <script src="media/js/bootstrap.min.js"></script>

  <script type="text/javascript" src='media/js/jquery-1.7.min.js'></script>
  <script type="text/javascript" src='media/js/lib.js'></script>
  <script type="text/javascript" src='media/js/jquery.tablesorter.js'></script>
</head>

<body>

  <div class="container">
    <div class="header clearfix">
      <h3 class="text-muted">Réducteur d'URL</h3>
    </div>

    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #256aa9;">
      <ul class="navbar-nav mr-auto">
        <?php
        if ($_SERVER['PHP_SELF']!='/redirect.php') {
            if ($_SERVER['PHP_SELF']=='/ajout.php') {
                echo"<li class='nav-item active'><a class='nav-link' href='ajout.php'>Raccourcir une URL</a></li>";
            } else {
                echo"<li class='nav-item'><a class='nav-link' href='ajout.php'>Raccourcir une URL</a></li>";
            }
            if ($_SERVER['PHP_SELF']=='/generer.php') {
                echo"<li class='nav-item active'><a class='nav-link' href='generer.php'>Générer un QR Code</a></li>";
            } else {
                echo"<li class='nav-item'><a class='nav-link' href='generer.php'>Générer un QR Code</a></li>";
            }
            if ($_SERVER['PHP_SELF']=='/liste.php') {
                echo"<li class='nav-item active'><a class='nav-link' href='liste.php'>Liste des URL courtes</a></li>";
            } else {
                echo"<li class='nav-item'><a class='nav-link' href='liste.php'>Liste des URL courtes</a></li>";
            }
            if ($_SERVER['PHP_SELF']=='/permissions.php') {
                echo"<li class='nav-item active'><a class='nav-link' href='permissions.php'>Permissions</a></li>";
            } else {
                echo"<li class='nav-item'><a class='nav-link' href='permissions.php'>Permissions</a></li>";
            }
        }
        ?>
      </ul>
    </nav>
