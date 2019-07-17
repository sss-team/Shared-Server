<?php
    $title = "Fonctionnalités";
    ob_start();
    require("../public/link_bt/link_bt_fonction.html");
    $entete = ob_get_clean();

    ob_start();
    require("../public/style/style_fonction.html");
    $style = ob_get_clean();

    ob_start();
    require("../public/script/script_fonction.html");
    $script = ob_get_clean();

    ob_start();
?>

<div class="topnav">
    <a href="../index.php">Accueil</a>
    <a class="active" href="fonctionnalite.php">Fonctionnalités</a>
    <a href="gallerie.php">Gallerie</a>
    <a href="membre.php">Membres</a>
    <a href="contact.php"> Nous contacter </a>
    <a href="downapp.php"> Télécharger </a>
</div>


<div class="conteneur1" class="col-sm-6 col-md-4 col-lg-2">
    <h1> SHARED-SERVER </h1>
        <p> 
            Shared-server a quatre fonctionnalités principales sans compter comme  la création de goupe de partage dans le plateforme. Shared-server est donc un plateforme multifonctionnel capable de gérer des fichiers et des échanges d'informations.
        </p>      
</div>
        
<div class="boutons">
    <button type="button" class="btn btn-info" title="Stockez vos fichiers personnels dans notre serveur avec sécurité. "> Stockage de fichiers</button>
    <button type="button" class="btn btn-success" data-toggle="tooltip" title="Partagez  vos fichiers personnels avec vos collègues de travail ou dans votre groupe de travail.">Partage de fichiers</button>
    <button type="button" class="btn btn-warning"  data-toggle="tooltip" title="Discutez avec vos collègues pour faciliter les échanges d'informations.">Chat et Appel</button>
    <button type="button" class="btn btn-danger" data-toggle="tooltip" title="Vous pouvez aussi utliser l'application mobile Shared-server sur votre Smartphone android.">Doter d'une application <br> mobile</button>
</div>

<?php
$content = ob_get_clean();
require("template.php");
?>