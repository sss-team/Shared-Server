<?php
session_start();
include('funct.php');

if(isset($_POST['supprimer']))
{
    $groupe = $_SESSION['groupe_perso'];
}
elseif(isset($_POST['supprimer_file_groupe']))
{
    $groupe = $_SESSION['name_groupe'];
}
    $file_name = $_POST['fichier_a_suppr'];
    $proprietaire = $_POST['name_prop'];
    $groupe_file = $_POST['groupe_file'];
    

    $suppr_bdd = $bdd->exec('Delete from file where user_name="'.$proprietaire.'" and file_name="'.$file_name.'" and groupe_name="'.$groupe_file.'" ');

    $connectio_ssh2 = ssh2_connect('localhost', 22);
    ssh2_auth_password($connectio_ssh2, 'mm', 'azert');
    ssh2_exec($connectio_ssh2, 'rm /var/www/html/Web/Dossier/"'.$groupe.'"/"'.$file_name.'"');

    
if(isset($_POST['supprimer']))
{
    header("Location: test.php?id=".$_SESSION['id']);
}
elseif(isset($_POST['supprimer_file_groupe']))
{
    header("Location: user_groupe.php?id=".$_SESSION['id']."&liens=".$groupe);
}
?>