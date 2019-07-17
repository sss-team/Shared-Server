<?php
    $title ="Membres";
    ob_start();
    require("../public/link_bt/link_bt_membre.html");
    $entete = ob_get_clean();

    ob_start();
    require("../public/style/style_membre.html");
    $style = ob_get_clean();

    ob_start();
?>

<div class="topnav">
  			<a href="../index.php">Accueil</a>
  			<a  href="fonctionnalite.php">Fonctionnalités</a>
  			<a  href="gallerie.php">Gallerie</a>
  			<a class="active" href="membre.php">Membres</a>
  			<a href="contact.php"> Nous contacter </a>
  			<a href="downapp.php"> Télécharger </a>
		</div>
		
		
		<div class="CA">
		       <div class="card1">
		       		<div class="card" style="width: 500px;">
					<img src="../public/image/gae.JPG" class="card-img-top" alt="gaetan">
						<div class="card-body text-center">
		    					<h5 class="card-title"> <b> BAKARY Gaetan Jonathan </b></h5>
		   			        	<p class="card-text">  Administrateur Serveur et Developpeur d'application mobile</p>
		   			        	<i class="fa fa-linkedin"></i>     <i class="fa fa-facebook"> </i> 
	       					</div>
	    			</div>
	    		</div>
	    		<div class="card2">
		    		<div class="card"  style="width: 500px;">
					<img src="../public/image/ld.JPG" class="card-img-top" alt="Landry">
						<div class="card-body text-center">
			    				<h5 class="card-title"> <b> RASENDRANIRINA Manankoraisina Landry </b> </h5>
			   			        <p class="card-text">  Developpeur Web et Administrateur Système Linux </p>
			    				<i class="fa fa-linkedin">   </i>     <i class="fa fa-facebook"> </i> 
		       				</div>
		    		</div>
		    	</div>
		    	<div class="card3">
		    		<div class="card"  style="width: 500px;">
					<img src="../public/image/merv.JPG" class="card-img-top" alt="Merveilleuse">
						<div class="card-body text-center">
			    				<h5 class="card-title"> <b> TSIMAGNEKY Merveilleuse Mboahazy Fitia </b> </h5>
			   			        <p class="card-text">  Developpeur Web Front-End</p>
			    				<i class="fa fa-linkedin"> </i>    <i class="fa fa-facebook"> </i> 
		       				</div>
		    		</div>
		    	</div>
		    	<div class="card4">
		    		<div class="card"  style="width: 500px;">
					<img src="../public/image/off.jpg" class="card-img-top" alt="Offman">
						<div class="card-body text-center">
			    				<h5 class="card-title"> <b> BIENVENU Jean Offman </b> </h5>
			   			        <p class="card-text">  Administrateur de Base de donnée, Developpeur PHP</p>
			    				<i class="fa fa-linkedin"> </i>    <i class="fa fa-facebook"> </i> 
		       				</div>
		    		</div>
		    	</div>
		    	<div class="card5">
		    		<div class="card"  style="width: 500px;">
					<img src="../public/image/nn.JPG" class="card-img-top" alt="Ntsoa">
						<div class="card-body text-center">
			    				<h5 class="card-title"> <b> MIHAINGOHERILANTO Manambintsoa </b></h5>
			   			        <p class="card-text">Administrateur de Base de donnée, Developpeur PHP </p>
			    				<i class="fa fa-linkedin"> </i>    <i class="fa fa-facebook"> </i> 
		       				</div>
		    		</div>
		    	</div>
           </div>

<?php
$content = ob_get_clean();
require("template.php");
?>