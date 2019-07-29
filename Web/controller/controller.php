<?php
require_once("model/Model.php");

function page1(){
    require("view/ss1.php");
}

function inscrire(){
    require("view/create.php");
}

function ajouter_membre(){
    require("view/ajouter_membre.php");
}

function login($name_or_email, $passwd){
    $query_bdd = new Query_bdd;
    $verify_login = $query_bdd->connect($name_or_email);
    $info_user = $verify_login->fetch();
    
    if($verify_login === false or $info_user['id'] ==''){
        $verify = "error";
        require("view/ss1.php");
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
            $temps_actuelle = time();
            $user_connecter = $query_bdd->marquer_connecter($user_name, $temps_actuelle);
            if($user_connecter === false){
                throw new Exception("Erreur de la mis en ligne de l'utilisateur");
            }
            else{
                header("Location:index.php?action=connecter&user_name=$user_name&id=$id");
            }
        }
        else{
            $verify = "error_mdp";
            require("view/ss1.php");
        }

    }
}

function list_file($user_name, $id){
    $query_bdd = new Query_bdd;
    $files = $query_bdd->post_files($user_name);
    $groupes_user = $query_bdd->select_groupe_user($id);
    $mes_groupes = $query_bdd->select_mes_groupe($user_name);
    $users_connecter = $query_bdd->select_user_connecter();

    if($files === false){
        throw new Exception("Probléme sur files ");
    }
    else{
        if($groupes_user === false or $mes_groupes === false or $users_connecter === false){
            throw new Exception("Probléme sur groupes_user ou mes_groupes");
        }
        else{
            $user_files = $user_name;
            require("view/application.php");
        }
    }
}

function delete_file($name_file, $groupe_file, $name_prop, $type){
    $query_bdd = new Query_bdd;

    $verify_delete = $query_bdd->delete_file_user($name_file, $groupe_file, $name_prop, $type);

    if($verify_delete === false){
        throw new Exception("Probléme de suppression");
    }
    else{
        $id_users = $query_bdd->select_id_user($name_prop);
        $id_user = $id_users->fetch();
        $id = $id_user['id'];

        $id_groupes = $query_bdd->select_id_groupe($groupe_file);
        $id_groupe_user = $id_groupes->fetch();
        $id_groupe = $id_groupe_user['id_groupe'];
        header("location:index.php?action=my_groupe&groupe_name=$groupe_file&user_name=$name_prop&id=$id");
    }

}

function delete_file_my_groupe($name_file, $groupe_file, $name_prop, $type, $user_name){
    $query_bdd = new Query_bdd;

    $verify_delete = $query_bdd->delete_file_user($name_file, $groupe_file, $name_prop, $type);

    if($verify_delete === false){
        throw new Exception("Probléme de suppression");
    }
    else{
        $id_users = $query_bdd->select_id_user($user_name);
        $id_user = $id_users->fetch();
        $id = $id_user['id'];

        $id_groupes = $query_bdd->select_id_groupe($groupe_file);
        $id_groupe_user = $id_groupes->fetch();
        $id_groupe = $id_groupe_user['id_groupe'];
        header("location:index.php?action=my_groupe&groupe_name=$groupe_file&user_name=$user_name&id=$id");
    }

}


function insert_new_member($name_insert_groupe, $droit_ajout, $droit_suppr_file, $name_groupe){
    if($droit_ajout == 'on'){
        $droit_ajout = 1;
    }
    else{
        $droit_ajout = 0;
    }

    if($droit_suppr_file == 'on'){
        $droit_suppr_file = 1;
    }
    else{
        $droit_suppr_file = 0;
    }

    $query_bdd = new Query_bdd;
    $id_users = $query_bdd->select_id_user($name_insert_groupe);
    $id_user = $id_users->fetch();
    $id = $id_user['id'];

    $id_groupes = $query_bdd->select_id_groupe($name_groupe);
    $id_groupe_user = $id_groupes->fetch();
    $id_groupe = $id_groupe_user['id_groupe'];
    
    $verify_insert_member = $query_bdd->insertion_member_groupe($name_groupe, $id_groupe, $id, $droit_ajout, $droit_suppr_file);
    if($verify_insert_member === false or !isset($name_groupe) or !isset($id_groupe) or !isset($id) or !isset($droit_ajout) or !isset($droit_suppr_file)){
        $erreur = "erreur d'ajout";
        require("view/ajouter_membre.php");
    }
    else{
        $erreur = "$name_insert_groupe est bien ajouté au groupe $name_groupe";
        require("view/ajouter_membre.php");
    }
}


function new_groupe($user_name, $name_new_groupe, $id){
    $verify_espace = strpos($name_new_groupe, " ");
    if(strlen($name_new_groupe)<26 or !isset($verify_espace)){
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
            $error_name_groupe = "Nom de groupe déjà utilisé";
            throw new Exception("Nom de groupe déjà utilisé");
        }
    }
    else{
        $error_name_groupe = "Le nom de groupe doit comporter au plus 26 caractères sans espaces";
        throw new Exception("Le nom de groupe doit comporter au plus 26 caractères sans espaces");
    }


}

function list_file_my_groupe($groupe_name, $user_name, $id){
    $query_bdd = new Query_bdd;

    $files_my_groupe = $query_bdd->select_files_my_groupe($groupe_name);
    $createur_groupe_tab = $query_bdd->select_createur_groupe($groupe_name);
    $files = $files_my_groupe;
    $groupes_user = $query_bdd->select_groupe_user($id);
    $mes_groupes = $query_bdd->select_mes_groupe($user_name);

    $membre_groupe = $query_bdd->select_membre_groupe($groupe_name);
    $nbr_membre = count($membre_groupe);

    $createur_groupe_tabs = $createur_groupe_tab->fetch();
    $createur_groupe = $createur_groupe_tabs['createur_groupe'];
    if($files === false){
        throw new Exception("Probléme sur files ");
    }
    else{
        if($groupes_user === false or $mes_groupes === false){
            throw new Exception("Probléme sur groupes_user ou mes_groupes");
        }
        else{
            
            $affichage_files_groupe = $groupe_name;            
            require("view/application.php");
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
        if(preg_match("#^[a-z0-9._-]+@esti.mg$#",$email)){
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
                $erreur = "Confirmation de Mot de passe incorrect";
                require("view/create.php");
            }
        }
        else{
            $erreur = "Email adresse incorrecte";
            require("view/create.php");
        }
    }
    else{
        $erreur = "Username déjà utilisé";
        require("view/create.php");
    }
}

function se_deconnecter($user_name){
    $query_bdd = new Query_bdd;
    $deconnecter_user = $query_bdd->user_deconnection($user_name);
    if($deconnecter_user === false){
        throw new Exception("Erreur déconnection");
    }
    else{
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location:index.php");
    }
}

function verification_user_connecter(){
    $query_bdd = new Query_bdd;
    $temps_connection = $query_bdd->select_temps_deb_connection();
    $temps_actuelle = time();
    while($temp_connection = $temps_connection->fetch()){
        $t_connection = $temp_connection['temps_connection'];
        if($temps_actuelle - 360>$t_connection){
            $deconneter_cet_user = $query_bdd->deconnection_user_inactif($t_connection);
            if($deconneter_cet_user === false){
                throw new Exception("Erreur de la déconnexion utilisateur inactif");
            }
        }
    }
}

function mise_a_jour_temps_connection($user_name){
    $query_bdd = new Query_bdd;
    $update_temps_connection = $query_bdd->modify_temps_connection($user_name);
    if($update_temps_connection === false){
        throw new Exception("Erreur mis à jours temps connection");
    }
}


function insertion_fichier($id, $fichier_temporaire, $code_erreur, $user_name, $file_name, 
                            $groupe_name, $description_file, $destination){
    $query_bdd = new Query_bdd;
    
    switch($code_erreur)
    {
        case UPLOAD_ERR_OK:
            if(copy($fichier_temporaire, $destination)){
                $verify_insertion = $query_bdd->insert_new_file($user_name, $file_name, $groupe_name, $description_file, $destination);
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