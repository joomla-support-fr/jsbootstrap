jsbootstrap
===========
TODO
----
- voir RTL
- créer logo et icone JSB
- error.php et offline.php avec un look bootstrap

15/10/2012 07:00 by Lomart
--------------------------
- modification d'index.php, déplacement de l'appel jQuery

10/10/2012 07:00 by Lomart
--------------------------
- compilation LESS avec Crunch

09/10/2012 16:00 by Lomart
--------------------------
- suppression des personnalisation dans variables.less

09/10/2012 14:00 by Lomart
--------------------------
- ajout method="upgrade" dans templateDetails.xml
- index.php: pas de chargement custom.css si css_file=-1
- contrôle par vérificateurs en ligne correction syntaxe
  - fermeture balise link
  - suppression charset html5 dans index.php
- surcharge partielle de mod_menu (gestion dropdown)
- conversion less pour jsb-extended-menu.less (prise en charge de variables.less)

06/10/2012 22:00 by Lomart
--------------------------
- correction erreur </div> manquante
- erreur dans appel shim
- ajout de classes dans body pour permettre style selon contenu
- chgt variable index.php $layout en $gridfluid
- chgt nom dossier img en images
- ajout dossier images/system avec icones à personnaliser
- surcharge com_content/features (blog en vedette)
- surcharge pagination.php. Utilisation de btn-group
- nouveau error.php et error.css (non finalisé)
- petits bugs divers


05/10/2012 14:00 by Lomart
--------------------------
- ajout balise sémantique HTML5
- nettoyage dossier HTML
- récriture com_content/article/default.php
- ajout règle jsb/edition.less : align-right

01/10/2012 10:00 by Lomart
--------------------------
- création d'un fichier historique des versions : history.txt
- déplacement du contenu du dossier LESS-BASE dans le dossier LESS
- custom.less: ajout import variables.less et mixins.less
- ajout error.php de starter et css/error.css. de system/css
- error.php: correction chemin vers icone et css
- error.php: correction erreur sur champ recherche
- jsb-positions: réduction marge body de 20 à 10px en mode phone
- jsb-positions: centrage par défaut du contenu des footer (strater)

30/09/2012 16:00 by Lomart
--------------------------
- suppression des personnalisations less et css
- remplacement variables.less par celui d'origine
- correction xml language
- installable sur Joomla 3.0