<?php
require("inc/header.php");
if(!droitsAppli($_SESSION['cas_user'])){
	header("location: forbidden.php");
}

echo "<section class='row'>
			<div class='col'>
				<h3><p class='text-center'>Liste des URL courtes</p></h3>
			</div>
		</section>";

if(isset($_POST['del'])){
	delURL($_POST['id_url']);
}

if(isset($_POST['mod'])){
	$infos_url=getInfosFromidURL($_POST['id_url']);
        $error="";
        $longurl=$_POST['longurl'];

        if(empty($_POST['shorturl'])){
                //Pas de short URL fournie, on en génère une
                $shorturl=genereShortURL();
        }
        else{
                $shorturl=$_POST['shorturl'];
        }

        if(!isLongURLValid($longurl)) {
                $error.="URL longue invalide<br />";
        }
        if(!isShortURLValid($shorturl)) {
                $error.="URL courte invalide<br />";
        }
        elseif((isShortURLExist($shorturl))&&($shorturl!=$infos_url['short_code'])){
                $error.="Cette URL courte est déjà utilisée<br />";
        }

	if(empty($error)){
		modURL($_POST['id_url'],$longurl,$shorturl);
	}
}

if((isset($_POST['btnmod']))||(!empty($error))){
	if(!empty($error)){
		$infos_url['long_url']=$longurl;
		$infos_url['short_code']=$shorturl;
                echo "<div id='error'>$error</div>";
	}
	else{
		$infos_url=getInfosFromidURL($_POST['id_url']);
	}
	echo formModURL($_POST['id_url'],$infos_url['long_url'],$infos_url['short_code']);
}
$_urls=getAllURL();

?>
<table id='myTable' class='tablesorter table table-sm'>
<thead><tr><th scope="col">URL courte</th><th scope="col">URL longue</th><th scope="col">Créateur</th><th scope="col">Date de création</th><th scope="col">Hits</th><th scope="col">Actions</th></tr></thead>
<tbody>
<?php
foreach($_urls as $url){
	if(($userPermission>=2)||($url['creator_uid']==$_SESSION['cas_user'])){
		//On affiche aux gestionnaires ou + et au propriétaire de la redirection
		$shortcode="<a href='".$_URL_REDUCTEUR."/".$url['short_code']."'>".$url['short_code']."</a><a href=\"qrcodegen.php?code=".$_URL_REDUCTEUR."/".$url['short_code']."\"><img id='bouton-qrcode' src='media/images/icons/qrcode.png'/></a>";
		if(strlen($url['long_url'])>70){
			$longurl="<span title='".$url['long_url']."'>".substr($url['long_url'],0,70)."...</span>";
		}
		else{
			$longurl=$url['long_url'];
		}
		if($url['last_http_respcode']>400){
			echo "<tr class='table-danger'>";
		}
		else{
			echo "<tr>";
		}
			echo "<td>$shortcode</td><td>$longurl <a href=\"qrcodegen.php?code=".$url['long_url']."\"><img id='bouton-qrcode' src='media/images/icons/qrcode.png'/></a></td>
			<td>".$url['creator_uid']."</td><td>".$url['date_created']."</td>
			<td>".$url['counter']."</td>
			<td><table class='table-borderless'><tr><td>".formBtnModURL($url['id'])."</td><td>".formBtnDelURL($url['id'])."</td></tr></table></td>";
			echo "</tr>";
	}
}
?>
</tbody>
</table>

<script type="text/javascript">
$(document).ready(function()
{
        $("#myTable").tablesorter();
}
);
</script>

<?php
require("inc/footer.php");
?>
