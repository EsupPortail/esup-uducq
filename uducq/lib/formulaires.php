<?php

#Formulaire de création de compte applicatif
function formAdduserAppli($permission)
{
    if ($permission>=2) {
        echo "<form method='post' action='' name='formAdduserAppli' class='form-inline'>
           <div class='input-group sm-3'>
           <div class='input-group-prepend'>
           <span class='input-group-text' id='basic-addon'>Ajouter un utilisateur :</span>
           </div>
           <input type='text' class='form-control' id='basic-url' aria-describedby='basic-addon' placeholder='login'  name='login'>
           </div>
                     <button type='submit' name='add' class='btn btn-primary ml-1'>Ajouter</button>

              </form><br />";
    }
}

function formDeluserAppli($user)
{
    $form="<form method='POST' action=''><input type='hidden' name='user' value='".$user."'><input onclick=\"return(confirm('Etes-vous sûr de vouloir supprimer l\'utilisateur ".$user."?'))\" type='submit' value='' name='del' title='Supprimer' id='bouton-del' /></form>";
    return $form;
}

function formModuserAppli($user, $mod)
{
    switch ($mod) {
           case 'U':
                $form="<form method='POST' action=''><input type='hidden' name='user' value='".$user."'><input type='hidden' name='type_mod' value='1'><input type='submit' value='' name='mod' title='Utilisateur' id='bouton-user' /></form>";
                break;
           case 'G':
                $form="<form method='POST' action=''><input type='hidden' name='user' value='".$user."'><input type='hidden' name='type_mod' value='2'><input type='submit' value='' name='mod' title='Gestionnaire' id='bouton-gest' /></form>";
                break;
           case 'A':
                $form="<form method='POST' action=''><input type='hidden' name='user' value='".$user."'><input type='hidden' name='type_mod' value='3'><input type='submit' value='' name='mod' title='Administrateur' id='bouton-admin' /></form>";
                break;
        }
    return $form;
}

function formAddURL($valuelong, $valueshort)
{
    global $_URL_REDUCTEUR ;
    $form="<form method='post' action='' name='formAddURL'>
  <div class='form-row'>
  <div class='col-7'>
  URL longue
  <input type='text' class='form-control' placeholder='$valuelong' name='longurl'>
  </div>
  </div>
  <div class='form-row mt-2'>
  <div class='col-7'>
  <label for='basic-url'>URL courte</label>
  <div class='input-group sm-3'>
  <div class='input-group-prepend'>
  <span class='input-group-text' id='basic-addon3'>". $_URL_REDUCTEUR ."</span>
  </div>
  <input type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' placeholder='$valueshort'  name='shorturl'>
  </div>
  <small class='form-text text-muted'>Si aucune URL courte n'est renseignée, un code de 6 caractères sera généré.</small>
  </div>
  </div>
  <button type='submit' name='add' class='btn btn-primary mt-3'>Ajouter</button>
  </form>";
    return $form;
}

function formModURL($id_url, $valuelong, $valueshort)
{
    global $_URL_REDUCTEUR ;
    $form="<form method='post' action='' name='formModURL'>
  <div class='form-row'>
  <div class='col-7'>
  URL longue
  <input type='text' class='form-control' value='$valuelong' name='longurl'>
  </div>
  </div>
  <div class='form-row mt-2'>
  <div class='col-7'>
  <label for='basic-url'>URL courte</label>
  <div class='input-group sm-3'>
  <div class='input-group-prepend'>
  <span class='input-group-text' id='basic-addon3'>". $_URL_REDUCTEUR ."</span>
  </div>
  <input type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='$valueshort'  name='shorturl'>
  </div>
  <small class='form-text text-muted'>Si aucune URL courte n'est renseignée, un code de 6 caractères sera généré.</small>
  </div>
  </div>
  <button type='submit' name='mod' class='btn btn-primary mt-3'>Modifier</button>
  <input type='hidden' name='id_url' value='$id_url'>
  </form>";
    return $form;
}

function formBtnDelURL($id_url)
{
    $form="<form method='POST' action=''><input type='hidden' name='id_url' value='$id_url'/><input onclick=\"return(confirm('Etes-vous sûr de vouloir supprimer cette URL ?'))\" type='submit' value='' name='del' title='Supprimer' id='bouton-del' /></form>";
    return $form;
}
function formBtnModURL($id_url)
{
    $form="<form method='POST' action=''><input type='hidden' name='id_url' value='".$id_url."'/><input type='submit' value='' name='btnmod' title='Modifier' id='bouton-mod' /></form>";
    return $form;
}

function formGenereURL($placeholder, $value="")
{
    $form="<form method='post' action='' name='formGenereURL'>
  <div class='form-row'>
  <div class='col-7'>
  URL";
    if (!empty($value)) {
        $form .= "<input type='text' class='form-control' placeholder='$placeholder' name='url' value='$value'/>";
    } else {
        $form .= "<input type='text' class='form-control' placeholder='$placeholder' name='url'/>";
    }

    $form .="</div>
  </div>
  <button type='submit' name='gen' class='btn btn-primary mt-3'>Generer</button>
  </form>";
    return $form;
}
