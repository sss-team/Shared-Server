<?php
require_once("model/Model.php");

function page1(){
    require("view/page1.php");
}

function inscrire(){
    require("view/inscription.php");
}

function login($name_or_email, $passwd){
    $query_bdd = new Query_bdd;
    $verify_login = $query_bdd->connect($name_or_email);
    $info_user = $verify_login->fetch();
    
    if($verify_login === false or $info_user['id'] ==''){
        $verify = "error";
        require("view/page1.php");
    }
    else{
        $verification_passwd = password_verify($passwd, $info_user['mdp']);
        if($verification_passwd){
            session_start();
            
            $_SESSION['id'] = $info_user['id'];
            $_SESSION['user_name'] = $info_user['user_name'];
            $_SESSION['mail'] = $info_user['mail'];
            $_SESSION['ver'] = $info_user['ver'];
            $id = $info_user['id'];
            $user_name = $info_user['user_name'];

            header("Location:index.php?action=connecter&user_name=$user_name&id=$id");
        }
        else{
            $verify = "error_mdp";
            require("view/page1.php");
        }

    }
}

function list_file($user_name, $id){
    $query_bdd = new Query_bdd;
    $files = $query_bdd->post_files($user_name);
    $groupes_user = $query_bdd->select_groupe_user($id);
    $mes_groupes = $query_bdd->select_mes_groupe($user_name);
    if($files === false){
        throw new Exception("Probléme sur files ");
    }
    else{
        if($groupes_user === false or $mes_groupes === false){
            throw new Exception("Probléme sur groupes_user ou mes_groupes");
        }
        else{
            $user_files = $user_name;
            require("view/acceuil.php");
        }
    }
}


function new_groupe($user_name, $name_new_groupe, $id){
    $query_bdd = new Query_bdd;
    $all_groupes = $query_bdd->select_all_groupe();
    while($all_groupe = $all_groupes->fetch()){
        $name_groupe = $all_groupe['name_groupe'];
        if($name_groupe == $name_new_groupe){
            $name_groupe_acceptable = 'false';
            break;
        }
    }

    if($name_groupe_acceptable != 'false'){
        $create_groupe = $query_bdd->create_new_groupe($user_name, $name_new_groupe, $id);
        if($create_groupe === false){
            throw new Exception("Problème création groupe");
        }
        else{
            header("Location:index.php?action=connecter&user_name=$user_name&id=$id");
        }
    }
    else{
        $error_name_groupe = "Nom du groupe déjà utilisé";
        throw new Exception("Nom du groupe déjà utilisé");
    }
}

function list_file_my_groupe($groupe_name, $user_name, $id, $id_my_groupe){
    $query_bdd = new Query_bdd;
    
    $files_my_groupe = $query_bdd->select_files_my_groupe($groupe_name);
    
    $files = $files_my_groupe;
    $groupes_user = $query_bdd->select_groupe_user($id);
    $mes_groupes = $query_bdd->select_mes_groupe($user_name);
    
    if($files === false){
        throw new Exception("Probléme sur files ");
    }
    else{
        if($groupes_user === false or $mes_groupes === false){
            throw new Exception("Probléme sur groupes_user ou mes_groupes");
        }
        else{
            
            $affichage_files_groupe = $groupe_name;
          
            require("view/acceuil.php");
        }
    }

}

function inscription($user_name, $email, $passwd, $confirmation_passwd){
    $query_bdd = new Query_bdd;
    $all_user_name = $query_bdd->user_names();

    while($user_name_existe = $all_user_name->fetch()){
        $name_existe = $user_name_existe['user_name'];
        if($name_existe == $user_name){
            $name_already_utile = "true";
        }
        else{
            $name_already_utile = "false";
        }
    }

    if($name_already_utile == "false"){
        if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$email)){
            if($passwd == $confirmation_passwd){
                $passwd_hash = password_hash($passwd, PASSWORD_ARGON2I);
                $insertion_info = $query_bdd->insertion_new_user($user_name, $email, $passwd_hash);
                if($insertion_info === false){
                    throw new Exception("Probléme d'insertion dans la bdd");
                }
                else{
                    login($user_name, $passwd);
                }
            }
            else{
                $erreur = "Confirmation de la Mot de passe incorrecte";
                require("view/inscription.php");
            }
        }
        else{
            $erreur = "Email adresse incorrecte";
            require("view/inscription.php");
        }
    }
    else{
        $erreur = "Username déjà utilisé";
        require("view/inscription.php");
    }
}

function se_deconnecter(){
    session_start();
    $_SESSION = array();
    session_destroy();
    header("Location:index.php");
}


function insertion_fichier($id, $fichier_temporaire, $code_erreur, $user_name, $file_name, 
                            $groupe_name, $description_file, $destination){
    $query_bdd = new Query_bdd;
    
    switch($code_erreur)
    {
        case UPLOAD_ERR_OK:
            if(copy($fichier_temporaire, $destination)){
                $verify_insertion = $query_bdd->insert_new_file($user_name, $file_name, $groupe_name, $description_file);
            }
            else{
                throw new Exception("Erreur copie fichier");
            }                           
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception("Aucun fichier séléctionner");
            break;
        case UPLOAD_ERR_INI_SIZE:
            throw new Exception("Taille fichier > upload_max_filesize");
            break;
        case UPLOAD_ERR_PARTIAL:
            throw new Exception("Fichier partiellement transféré");
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            throw new Exception("Aucun répertoire temporaire");
            break;
        case UPLOAD_ERR_CANT_WRITE:
            throw new Exception("Erreur lors de l’écriture du fichier sur disque");
            break;
        default:
            throw new Exception("Fichier non transféré");
            break;
    }
    if($verify_insertion === false){
        throw new Exception("Erreur insertion fichier");
    }
    else{
        if($user_name == $groupe_name){
            header("Location:index.php?action=connecter&user_name=$user_name&id=$id");
        }
        else{
            header("Location:index.php?action=my_groupe&groupe_name=$groupe_name&user_name=$user_name&id=$id");
        }
    }   
    
}