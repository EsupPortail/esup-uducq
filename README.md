# Utilitaire de diffusion d'URL courtes et QRCodes

Créée en 2013 et toujours utilisée pour les besoins de l'université de Lorraine, cette application simple, cassifiée, permet de générer des URL courtes et des QRCodes.

## Mode de fonctionnement
uducq.univ.fr est l'adresse d'administration de l'outil et uducq.fr est le domaine court des URL raccourcies (ex : uducq.fr/url_courte).

## Prérequis
- **phpCAS** doit être installé sur le serveur
- **mod_rewrite** doit être activé et paramétré ainsi pour rediriger les urls courtes vers la page redirect.php

    ```
    RewriteEngine On    
    RewriteRule ^([0-9a-z\-]{1,40})$ redirect.php?url=$1 [L]```
    ```


## Installation

Il y a deux dossiers à la racine du projet :

- `uducq.fr` qui correspond au code source de redirection des URL (uducq.fr/esup -> https://github.com/EsupPortail/esup-uducq). Il faut faire pointer le document root de ce domaine vers le dossier php.
- `uducq` qui correspond au code source de l'interface d'administration de l'outil. Il faut faire pointer le document root du domaine de l'interface d'administration (ex : uducq.univ.fr) vers le dossier php contenu dans ce dossier.


Il faut également initialiser la base de données avec la structure présente dans le fichier uducq.sql. Cette application étant uniquement cassifiée (pas de formulaire de connexion de comptes locaux), il convient de remplacer le *admin_cas* présent dans ce fichier par le login CAS du premier administrateur de l'application.

`sed -i 's/admin_cas/login_cas_admin_univ/' uducq.sql`
