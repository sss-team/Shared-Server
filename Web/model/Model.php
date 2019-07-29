<?php
require_once("Connect_bdd.php");

class Query_bdd extends Connect_bdd{
    public function connect($name_or_email){
        $bdd = $this->dbconnect();
        $verify_login = $bdd->prepare("SELECT * FROM membre WHERE (user_name = ? OR mail = ?) AND ver = 0 ");
        $verify_login->execute(array($name_or_email,$name_or_email));
        return $verify_login;
    }

    public function insertion_new_user($user_name, $email, $passwd_hash){
        $confirm_mail = 1111;
        $ver = 0;
        $bdd = $this->dbconnect();
        $temps_actuelle = time();
        $insertion_info = $bdd->prepare("INSERT INTO membre(user_name, mail, mdp, confirm_mail, ver, temps_connection) 
                                        VALUES(?,?,?,?,?,?)");
        $insertion_info->execute(array($user_name, $email, $passwd_hash, $confirm_mail, $ver, $temps_actuelle));

        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "mkdir /var/www/html/Shared-Server-1/Web/public/stockage/users/\"$user_name\" && chmod 777 /var/www/html/Shared-Server-1/Web/public/stockage/users/\"$user_name\"");
        return $insertion_info;
    }

    public function post_files($user_name){
        $bdd = $this->dbconnect();
        $files = $bdd->prepare("SELECT * FROM file WHERE groupe_name=?");
        $files->execute(array($user_name));
        return $files;
    }

    public function select_membre_groupe($groupe_name){
        $bdd = $this->dbconnect();
        $id_membres_groupe = $bdd->prepare("SELECT DISTINCT id FROM Groupe_membre WHERE groupe_name = ? ");
        $id_membres_groupe->execute(array($groupe_name));

        
        while($id_membre_groupe = $id_membres_groupe->fetch()){
            $id_membre = $id_membre_groupe["id"];
            $user_name_tab = $bdd->prepare("SELECT user_name FROM membre WHERE id=?");
            $user_name_tab->execute(array($id_membre));
            $user_name_fetch = $user_name_tab->fetch();
            $user_name = $user_name_fetch['user_name'];
            $user_name_array[] = $user_name;

        }
        return $user_name_array;
    }

    public function user_names(){
        $bdd = $this->dbconnect();
        $all_user_names = $bdd->prepare("SELECT user_name FROM membre");
        $all_user_names->execute();
        return $all_user_names;
    }

    public function marquer_connecter($user_name, $temps_actuelle){
        $bdd = $this->dbconnect();
        $user_connecter = $bdd->prepare("UPDATE membre SET ver=1 , temps_connection=? WHERE user_name=? ");
        $user_connecter->execute(array($temps_actuelle , $user_name));
        return $user_connecter;
    }

    public function select_temps_deb_connection(){
        $bdd = $this->dbconnect();
        $temps_connection = $bdd->query("SELECT temps_connection FROM membre");
        return $temps_connection;
    }

    public function deconnection_user_inactif($t_connection){
        $bdd = $this->dbconnect();
        $deconnecter_cet_user = $bdd->prepare("UPDATE membre SET ver=0 where temps_connection=?");
        $deconnecter_cet_user->execute(array($t_connection));
        return $deconnecter_cet_user;
    }

    public function modify_temps_connection($user_name){
        $temps_actuelle = time();
        $bdd = $this->dbconnect();
        $update_temps_connection = $bdd->prepare("UPDATE membre SET temps_connection = ? WHERE user_name=?");
        $update_temps_connection->execute(array($temps_actuelle, $user_name));
        return $update_temps_connection;
    }

    public function select_user_connecter(){
        $bdd = $this->dbconnect();
        $users_connecter = $bdd->query("SELECT user_name FROM membre WHERE ver=1");
        return $users_connecter;
    }

    public function user_deconnection($user_name){
        $bdd = $this->dbconnect();
        $deconnecter_user = $bdd->prepare("UPDATE membre SET ver = 0 WHERE user_name = ? ");
        $deconnecter_user->execute(array($user_name));
        return $deconnecter_user;
    }

    public function insert_new_file($user_name, $file_name, $groupe_name, $description_file, $destination){
        $bdd = $this->dbconnect();
        $insert_file = $bdd->prepare('INSERT INTO file(user_name, file_name, groupe_name, description_file) VALUES(?,?,?,?)');
        $insert_file->execute(array($user_name, $file_name, $groupe_name, $description_file));
        
        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "chmod 777 /var/www/html/Shared-Server-1/Web/\"$destination\"");

        return $insert_file;
    }

    public function delete_file_user($name_file, $groupe_file, $name_prop, $type){
        $bdd = $this->dbconnect();
        $verify_delete = $bdd->prepare("DELETE FROM file WHERE user_name=? and groupe_name=? and file_name=?");
        $verify_delete->execute(array($name_prop,  $groupe_file, $name_file ));

        if($type == "groupe"){
            $chemin = "/var/www/html/Shared-Server-1/Web/public/stockage/groupe";
        }
        elseif($type == "user"){
            $chemin = "/var/www/html/Shared-Server-1/Web/public/stockage/users";
        }

        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "rm $chemin/\"$groupe_file\"/\"$name_file\"");
        return $verify_delete;
    }

    public function select_groupe_user($id){
        $bdd = $this->dbconnect();
        $groupes_user = $bdd->prepare("SELECT * from Groupe_membre WHERE id =?");
        $groupes_user->execute(array($id));
        return $groupes_user;
    }

    public function select_mes_groupe($user_name){
        $bdd = $this->dbconnect();
        $mes_groupes = $bdd->prepare("SELECT * from groupe WHERE createur_groupe =?");
        $mes_groupes->execute(array($user_name));
        return $mes_groupes;
    }

    
    public function create_new_groupe($user_name, $name_new_groupe, $id){
        $bdd = $this->dbconnect();
        $create_groupe = $bdd->prepare("INSERT INTO groupe(name_groupe, createur_groupe) VALUES(?, ?)");
        $create_groupe->execute(array($name_new_groupe, $user_name));

        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "mkdir /var/www/html/Shared-Server-1/Web/public/stockage/groupe/\"$name_new_groupe\" && chmod 777 /var/www/html/Shared-Server-1/Web/public/stockage/groupe/\"$name_new_groupe\"");
        return $create_groupe;
    }

    public function select_createur_groupe($groupe_name){
        $bdd = $this->dbconnect();
        $createur_groupe = $bdd->prepare("SELECT createur_groupe FROM groupe WHERE name_groupe = ? ");
        $createur_groupe->execute(array($groupe_name));
        return $createur_groupe;
    }

    public function select_all_groupe(){
        $bdd = $this->dbconnect();
        $all_groupes = $bdd->query("SELECT name_groupe from groupe");
        return $all_groupes;
    }

    public function select_files_my_groupe($groupe_name){
        $bdd = $this->dbconnect();
        $files_my_groupe = $bdd->prepare("SELECT * from file WHERE groupe_name =?");
        $files_my_groupe->execute(array($groupe_name));
        return $files_my_groupe;
    }

    public function insertion_member_groupe($name_groupe, $id_groupe, $id, $droit_ajout, $droit_suppr_file){
        $bdd = $this->dbconnect();
        $verify_insert_member = $bdd->prepare("INSERT INTO Groupe_membre(groupe_name, id_groupe, id, droit_ajouter, droit_suppr)
                                                VALUES(?,?,?,?,?) ");
        $verify_insert_member->execute(array($name_groupe, $id_groupe, $id, $droit_ajout, $droit_suppr_file));
        return $verify_insert_member;
    }

    public function select_id_user($user_name){
        $bdd = $this->dbconnect();
        $id = $bdd->prepare("SELECT id from membre WHERE user_name = ?");
        $id->execute(array($user_name));
        return $id;
    }

    public function select_id_groupe($name_groupe){
        $bdd = $this->dbconnect();
        $id_groupe = $bdd->prepare("SELECT id_groupe from groupe WHERE name_groupe = ?");
        $id_groupe->execute(array($name_groupe));
        return $id_groupe;
    }
}