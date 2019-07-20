<?php
require_once("controller/controller.php");

try{
    if(isset($_GET['action'])){
        $action = htmlspecialchars($_GET['action']);
        if($action == 'se_connecter'){
            $name_or_email = htmlspecialchars($_POST['name_or_email']);
            $passwd = htmlspecialchars($_POST['passwd']);
            login($name_or_email, $passwd);
        }

        elseif($action == 'connecter'){
            if(isset($_GET['user_name']) and isset($_GET['id'])){
                $user_name = htmlspecialchars($_GET['user_name']);
                $id = htmlspecialchars($_GET['id']);
                list_file($user_name, $id);
            }
        }

        elseif($action == 'inscrire'){
            inscrire();
        }

        elseif($action == 'inscription'){
            $user_name = htmlspecialchars($_POST['user_name']);
            $email = htmlspecialchars($_POST['email']);
            $passwd = htmlspecialchars($_POST['passwd']);
            $confirmation_passwd = htmlspecialchars($_POST['confirmation_passwd']);
            inscription($user_name, $email, $passwd, $confirmation_passwd);
        }

        elseif($action == 'se_deconnecter'){
            se_deconnecter();
        }

        elseif($action == 'create_groupe' and isset($_GET['user_name']) and isset($_GET['id'])){
            $user_name = htmlspecialchars($_GET['user_name']);
            $name_new_groupe = htmlspecialchars($_POST['name_new_groupe']);
            $id = htmlspecialchars($_GET['id']);
            new_groupe($user_name, $name_new_groupe, $id);
        }

        elseif($action == 'my_groupe' and isset($_GET['groupe_name']) and 
            isset($_GET['user_name']) and isset($_GET['id'])){
                $groupe_name = htmlspecialchars($_GET['groupe_name']);
                $user_name = htmlspecialchars($_GET['user_name']);
                $id = htmlspecialchars($_GET['id']);
                $id_my_groupe = htmlspecialchars($_GET['id_my_groupe']);
                list_file_my_groupe($groupe_name, $user_name, $id, $id_my_groupe);
        }

        elseif($action == 'ajouter_fichier'){
            if(isset($_POST['envoyer_fichier']) and isset($_FILES['fichier'])){
                $oFileInfos = $_FILES["fichier"]; 
                $file_name= $oFileInfos["name"]; 
                $type_mime = $oFileInfos["type"]; 
                $taille = $oFileInfos["size"]; 
                $fichier_temporaire = $oFileInfos["tmp_name"]; 
                $code_erreur = $oFileInfos["error"]; 
                $description_file = $_POST["description_file"];

                session_start();
                $user_name = $_SESSION['user_name'];
                $groupe_name = $_SESSION['groupe_actif'];
                $id = $_SESSION['id'];
                if($user_name == $groupe_name){
                    $destination = "public/stockage/users/$user_name/$file_name";
                }
                else{
                    $destination = "public/stockage/groupe/$groupe_name/$file_name";
                }
                insertion_fichier($id, $fichier_temporaire, $code_erreur, $user_name, $file_name,
                                    $groupe_name, $description_file, $destination);
            }
            else{
                throw new Exception("Aucun fichier envoyer");
            }
        }
    }
    else{
        
        page1();
    }
}
catch(Exception $e){
    echo "Erreur :".$e->getMessage();
}
