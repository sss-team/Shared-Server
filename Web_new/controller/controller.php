<?php
require_once("model/Model.php");

function page1(){
    header("Location:view/page1.php");
}

function inscrire(){
    require("view/inscription.php");
}

function login($name_or_email, $passwd){
    $query_bdd = new Query_bdd;
    $verify_login = $query_bdd->connect($name_or_email);
    $info_user = $verify_login->fetch();
    
    if($verify_login === false or $info_user['id'] ==''){
        header("Location:view/page1.php?verify=error");
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
            header("Location:view/page1.php?verify=error_mdp");
        }

    }
}

function list_file($user_name){
    $query_bdd = new Query_bdd;
    $files = $query_bdd->post_files($user_name);
    require("view/acceuil.php");
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