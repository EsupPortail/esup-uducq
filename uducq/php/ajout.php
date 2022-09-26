<?php
require("inc/header.php");
if (!droitsAppli($_SESSION['cas_user'])) {
    header("location: forbidden.php");
}

if (!empty($_POST['longurl'])) {
    $error="";
    $longurl=$_POST['longurl'];

    if (empty($_POST['shorturl'])) {
        //Pas de short URL fournie, on en génère une
        $shorturl=genereShortURL();
    } else {
        $shorturl=$_POST['shorturl'];
    }

    if (!isLongURLValid($longurl)) {
        $error.="URL longue invalide<br />";
    }
    if (!isShortURLValid($shorturl)) {
        $error.="URL courte invalide<br />";
    } elseif (isShortURLExist($shorturl)) {
        $error.="Cette URL courte est déjà utilisée<br />";
    }
}

echo "<section class='row'>
			<div class='col'>
				<h3><p class='text-center'>Raccourcir une URL</p></h3>
			</div>
		</section>";

if ((isset($error))&&(empty($error))) {
    //pas de pb, on traite
    addURL($longurl, $shorturl);
    echo "<div class='alert alert-success' role='alert'>L'URL a été raccourcie</div>";
    $shorturl=$_URL_REDUCTEUR."/".$shorturl;
    echo "<p>URL longue : <a href='$longurl'>$longurl</a></p>";
    echo "<p>URL courte : <a href='$shorturl'>$shorturl</a></p>";
    echo "<p><table align='center'><tr><td align='center'><b>QRCode de l'URL longue</b><br /><img src=\"qrcodegen.php?code=".urlencode($longurl)."\" /></td>";
    echo "<td style='width:40px;'> </td><td align='center'><b>QRCode de l'URL courte</b><br /><img src=\"qrcodegen.php?code=".urlencode($shorturl)."\" /></td></tr></table></p>";
} else {
    if (isset($error)) {
        echo "<div class='alert alert-warning' role='alert'>$error</div>";
    }
    if (isset($_POST['longurl'])) {
        $valuelong=$_POST['longurl'];
    } else {
        $valuelong="https://moodle.univ.fr/mon/cours";
    }
    if (isset($_POST['shorturl'])) {
        $valueshort=$_POST['shorturl'];
    } else {
        $valueshort="coursmoodle";
    } ?>
	<br />
<?php

    echo formAddURL($valuelong, $valueshort);
}


require("inc/footer.php");
?>
