<?php

$text = "sdsdsdssdsd";
$a = strpos($text, " ");

echo $a;



echo "<br><br><br>";
/*
        $groupe_file = "je";
        $name_file = "(1)_Bethany_Worship_~_Speak_(Lyrics)_-_YouTube.mkv";
        $type = "user";
        if($type == "groupe"){
            $chemin = "/var/www/html/Shared-Server-1/Web/public/stockage/groupe";
        }
        elseif($type == "user"){
            $chemin = "/var/www/html/Shared-Server-1/Web/public/stockage/users";
        }

        echo "$chemin/$groupe_file/$name_file";

        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "rm $chemin/$groupe_file/\"$name_file\"");
        */


if (isset($_POST['login']) AND isset($_POST['pass']))
{
    $login = $_POST['login'];
    $pass_crypte = crypt($_POST['pass']); // On crypte le mot de passe

    echo '<p>Ligne à copier dans le .htpasswd :<br />' . $login . ':' . $pass_crypte . '</p>';
}

else // On n'a pas encore rempli le formulaire
{
?>

<p>Entrez votre login et votre mot de passe pour le crypter.</p>

<form method="post">
    <p>
        Login : <input type="text" name="login"><br />
        Mot de passe : <input type="text" name="pass"><br /><br />
    
        <input type="submit" value="Crypter !">
    </p>
</form>

<?php
}
?>
