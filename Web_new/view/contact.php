<?php
$title = "Contact";
ob_start();
require("../public/link_bt/link_bt_contact.html");
$entete = ob_get_clean();

ob_start();
require("../public/style/style_contact.html");
$style = ob_get_clean();

ob_start();
?>

<div class="topnav" class="col-sm-6 col-md-4 col-lg-2">
  			<a href="../index.php">Accueil</a>
  			<a  href="fonctionnalite.php">Fonctionnalités</a>
  			<a  href="gallerie.php">Gallerie</a>
  			<a  href="membre.php">Membres</a>
  			<a class="active"href="contact.php"> Nous contacter </a>
  			<a href="downapp.php"> Télécharger </a>
		</div>
		

<div class="contact-form" class="col-sm-6 col-md-4 col-lg-2">
	<form method="post">
        	<h1 class="cont">Contactez-nous</h1>
		<p class="hint-text">Vous aimeriez avoir de nos nouvelles, n'hésitez pas à nous contacter si vous avez des questions concernant nos produits ou services.</p>
		<div class="form-group">
			<label for="inputName">Name</label>
			<input type="text" class="form-control" id="inputName" name="" required>
		</div>
		<div class="form-group">
			<label for="inputEmail">Email Address</label>
			<input type="email" class="form-control" id="inputEmail"  name="" required>
		</div>
		<div class="form-group">
			<label for="inputMessage">Message</label>
			<textarea class="form-control" id="inputMessage" rows="5"  name="" required></textarea>
		</div>
		<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i> Send Message</button>
	</form>
</div>

<?php
$content = ob_get_clean();
require("template.php");
?>