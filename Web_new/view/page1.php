<?php
    $title = "Shared-Server";
	ob_start();
	require("../public/link_bt_page1.html");
    $entete = ob_get_clean();
	ob_start();
	require("../public/style_page1.html");
	$style = ob_get_clean();
	ob_start();
?>

<div class="topnav" class="col-sm-6 col-md-4 col-lg-2" >
  			<a class="active" href="index.html">Accueil</a>
  			<a href="fonction.html">Fonctionnalités</a>
  			<a href="gallery.html">Gallerie</a>
  			<a href="membre.html">Membres</a>
  			<a href="contact.html"> Nous contacter </a>
		</div>
		
		
		 <div class="conteneur1" class="col-sm-6 col-md-4 col-lg-2">
                   	<h1> SHARED-SERVER</h1>
                   	<p> Voulez-vous faciliter le partage de fichier dans votre entreprise ou dans votre société? Vous êtes dans le bon endroit. Sharedserver est  une plateforme disponible en réseau  local et sur  mobile android qui permet de faire cela. Elle vous donne une expérience de partage de fichier: fluide, rapide et sécurisé. Vous pouvez aussi discuter avec les  personnels dans votre entreprise ou société grâce au chat et <a class="lienvoip" href="https://fr.wikipedia.org/wiki/Voix_sur_IP "> VOIP </a>. Sans oublier que vous pouviez aussi stocker vos fichiers  personnels dans cette plateforme sans problème. 
                   	</p>      
            	</div>
            	
            	
            
            	<div class="boutons" class="col-sm-6 col-md-4 col-lg-2"> 
            		<button type="button" class="btn btn-outline-info" href="#myModal"  data-toggle="modal" >Se connecter</button> 
            		<button onclick='window.location="../index.php?action=inscrire"' type="button" class="btn btn-outline-danger">S'inscrire gratuitement maintenant</button>
            	</div>

            	
            	<!-- Modal HTML -->
	<div id="myModal" class="modal fade">
	

		<div class="modal-dialog modal-login">
			<div class="modal-content">
				<div class="modal-header">
               				 <div class="avatar"><i class="material-icons">&#xE7FD;</i></div>
               				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<form action="../index.php?action=se_connecter" method="post">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Nom d'utilisateur ou adresse email" name="name_or_email" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Mot de passe" name="passwd" required>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary btn-block btn-lg" name="se_connecter" value="Login">
						</div>
						
					</form>				
					<div class="hint-text small"><a href="#">Forgot Your Password?</a></div>
				</div>
			</div>
		</div>
	</div>  

    <?php
    if(isset($_GET['verify'])){
        $verify = htmlspecialchars($_GET['verify']);
        if($verify == 'error')
        {                           
            echo '<font color="red">Nom d\'utilisateur incorrecte</font>';
		}
		elseif($verify == 'error_mdp'){
			echo '<font color="red">Mot de passe incorrecte</font>';
		}
	}
	?>

<?php
$content = ob_get_clean();
require("template.php");
?>