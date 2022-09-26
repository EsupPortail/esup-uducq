<?php
require("inc/header.php");
if(!droitsAppli($_SESSION['cas_user'])){
	header("location: forbidden.php");
}

if(isset($_POST['add'])){
	if(!checkUserAppli($_POST['login'])){
		addUserAppli($_POST['login'],1);
	}
	else{
		echo "<div class='alert alert-danger' role='alert'>Cet utilisateur est déjà dans la liste.</div>";
	}
}

if(isset($_POST['del'])){
	delUserAppli($_POST['user']);
}

if(isset($_POST['mod'])){
	modUserAppli($_POST['user'],$_POST['type_mod']);
}

echo "<section class='row'>
			<div class='col'>
				<h3><p class='text-center'>Utilisateurs de l'application</p></h3>
			</div>
		</section>
		<section class='row float-right'>
					<div class='col'>";
formAdduserAppli($userPermission);
echo "			</div>
		</section>";
?>
<table class='table table-sm'>
<tr><td class='text-center'>
<h4>Administrateurs</h4>
<p class='text-muted small'>Peut ajouter des gestionnaires et voir toutes les URL</p>
</td><td class='text-center'>
<h4>Gestionnaires</h4>
<p class='text-muted small'>Peut ajouter des utilisateurs et voir toutes les URL</p>
</td>
<td class='text-center'>
<h4>Utilisateurs</h4>
<p class='text-muted small'>Peut créer des URL et voir/modifier les siennes</p>
</td></tr>
<tr><td>
<?php
listeUsersAppli($userPermission,3);
?>
</td><td>
<?php
listeUsersAppli($userPermission,2);
?>
</td><td>
<?php
listeUsersAppli($userPermission,1);
?>
</td></tr>

</table>
<?php
require("inc/footer.php");
?>
