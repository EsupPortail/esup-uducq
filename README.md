# Utilitaire de diffusion d'URL courtes et QRCodes

Créée en 2013 et toujours utilisée pour les besoins de l'université de Lorraine, cette application simple, cassifiée, permet de générer des URL courtes et des QRCodes.

Le mode de fonctionnement est le suivant : uducq.univ.fr est l'adresse d'administration de l'outil et uducq.fr est le domaine court des URL raccourcies (ex : uducq.fr/url_courte).


Il y a deux dossiers à la racine du projet :

- `uducq.fr` qui correspond au code source de redirection des URL (uducq.fr/esup -> https://github.com/EsupPortail/esup-uducq). Il faut faire pointer le document root de ce domaine vers le dossier php.
- `uducq` qui correspond au code source de l'interface d'administration de l'outil. Il faut faire pointer le document root du domaine de l'interface d'adminstration (ex : uducq.univ.fr) vers le dossier php contenu dans ce dossier.

Il est nécessaire d'installer phpCAS sur le serveur et le mod_rewrite apache.
