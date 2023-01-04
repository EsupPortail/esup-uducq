<?php
require("inc/header.php");
if (!droitsAppli($_SESSION['cas_user'])) {
    header("location: forbidden.php");
}

if (!empty($_POST['url'])) {
    $error="";
    $value=$_POST['url'];
    $placeholder=$value;
    if (!isLongURLValid($value)) {
        $error.="URL saisie invalide<br />";
    }
}

echo "<section class='row'>
			<div class='col'>
				<h3><p class='text-center'>Générer un QR Code</p></h3>
			</div>
		</section>";

if ((isset($error))&&(empty($error))) {
    //pas de pb, on traite
    echo formGenereURL($placeholder, $value);
?>
    <p>
        <table align="center">
            <tr>
                <td align="center">
                    <b>QR Code</b><br>
                    <img src="qrcodegen.php?code=<?php echo urlencode($value); ?>">
                </td>
            </tr>
        </table>
    </p>
<?php
} else {
    if (isset($error)) {
        echo "<div class='alert alert-warning' role='alert'>$error</div>";
    }
    if (isset($_POST['url'])) {
        $value=$_POST['url'];
    } else {
        $placeholder="https://moodle.univ.fr/mon/cours";
    } ?>
	<br />
<?php

    echo formGenereURL($placeholder);
}


require("inc/footer.php");
?>
