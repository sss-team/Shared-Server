<?php
    $title = "Shared_Server";
    ob_start();
?>

    <link rel="icon" type="image/png" href="Images/favicon-96x96.png" />
    <link href="../public/style_inscription.css" rel="stylesheet"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<?php
    $entete = ob_get_clean();
    ob_start();
?>

    <div class="signup-form">
        <form action="index.php?action=inscription" method="post">
            <h2>S'inscrire</h2>
            <p>Entrez les informations necéssaires s'il vous plait</p>
            <hr>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="user_name" placeholder="Username" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="passwd" placeholder="Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                        <i class="fa fa-check"></i>
                    </span>
                    <input type="password" class="form-control" name="confirmation_passwd" placeholder="Confirm Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-inline"><input type="checkbox" required="required"> J'accepte<a href="#">les conditions d'utilisation</a> &amp; <a href="#">Privacy Policy</a></label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg" name="s_inscrire">S'inscrire</button>
            </div>

            <?php
            if(isset($erreur))
            {
                echo '<font color="red">'.$erreur."</font>";
            }
            ?>
        </form>
        <div class="text-center">Avez-vous déjà un compte? <a  href="http://localhost/projet/Shared-Server-1/Web/shared-server.php" data-toggle="modal" >Se connecter ici</a></div>
    </div>

<?php
$content = ob_get_clean();
require("template.php");
?>