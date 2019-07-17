<?php
    $title = "Télécharger";

    ob_start();
    require("../public/link_bt/link_bt_downapp.html");
    $entete = ob_get_clean();

    ob_start();
    require("../public/style/style_downapp.html");
    $style = ob_get_clean();

    ob_start();
    require("../public/script/script_downapp.html");
    $script = ob_get_clean();

    ob_start();
?>

<div class="topnav"  id="myTopnav">
  			<a href="../index.php">Accueil</a>
  			<a href="fonctionnalite.php">Fonctionnalités</a>
  			<a href="gallerie.php">Gallerie</a>
  			<a href="membre.php">Membres</a>
  			<a href="contact.php"> Nous contacter </a>
  			<a class="active" href="downapp.php"> Télécharger</a>
  			<a href="javascript:void(0);" class="icon" onclick="myFunction()"> <i class="fa fa-bars"></i></a>
		</div>
		
		 <div class="conteneur1" class="col-sm-6 col-md-4 col-lg-2">
                   	<h1> <b> TELECHARGEMENT DE LOGICIEL </b></h1>
                   	<p> Pour faciliter l'utilisation de notre plateforme, nous avons créé un petit programme. Ce programme vous permettra d'accéder dans les dossiers de votre groupe à partir de votre explorateur de fichier en tapant simplement votre nom d'utilisateur et votre mot de passe. Ainsi, vous pouvez partagez et recevoir des fichiers sans vous rendre sur notre site web. A noter que cette fonctionnalité nécessite quand-même une connexion au réseau. Le programme est crossplateforme, elle peut donc fonctionner aussi bien sous windows que sous Linux. <br>Cliquez <a class="lienvoip" href="programme.html"> ici </a> pour voir les apperçus.
                   	</p>
                   	<div class="boutons">
                   		 <button class="btn" Onclick='window.location="shared-server.esti.mg/download/shared-server-linux.tar.gz"'> <i class="fa fa-download"></i> Télécharger <i class="fa fa-linux"></i></button>
                   		<button class="btn" Onclick='window.location="shared-server.esti.mg/download/shared-server-windows.zip"'s><i class="fa fa-download"></i> Télécharger <i class="fa fa-windows"></i></button>
                   	</div>      
</div>

<?php
$content = ob_get_clean();
require("template.php");
?>