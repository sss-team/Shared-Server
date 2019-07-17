<?php
    $title = "Créer un compte";
    ob_start();
    require('public/link_bt/link_bt_inscription.html');
    $entete = ob_get_clean();
    ob_start();
    require('public/style/style_inscription.html');
    $style = ob_get_clean();
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
                <label class="checkbox-inline"><input type="checkbox" required="required"> J'accepte <a href="#"> les conditions d'utilisation</a> &amp; <a href="#">Privacy Policy</a></label>
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
        <div class="text-center">Avez-vous déjà un compte? <a  href="index.php?action=se_connecter" data-toggle="modal" >Se connecter ici</a></div>
    </div>

<?php
$content = ob_get_clean();
require("template.php");
?>