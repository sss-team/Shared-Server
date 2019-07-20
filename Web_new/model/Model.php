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
        $insertion_info = $bdd->prepare("INSERT INTO membre(user_name, mail, mdp, confirm_mail, ver) 
                                        VALUES(?,?,?,?,?)");
        $insertion_info->execute(array($user_name, $email, $passwd_hash, $confirm_mail, $ver));

        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "mkdir /var/www/html/Shared-Server-1/Web_new/public/stockage/users/$user_name && chmod 777 /var/www/html/Shared-Server-1/Web_new/public/stockage/users/$user_name");
        return $insertion_info;
    }

    public function post_files($user_name){
        $bdd = $this->dbconnect();
        $files = $bdd->prepare("SELECT * FROM file WHERE groupe_name=?");
        $files->execute(array($user_name));
        return $files;
    }

    public function user_names(){
        $bdd = $this->dbconnect();
        $all_user_names = $bdd->prepare("SELECT user_name FROM membre");
        $all_user_names->execute();
        return $all_user_names;
    }

    public function insert_new_file($user_name, $file_name, $groupe_name, $description_file){
        $bdd = $this->dbconnect();
        $insert_file = $bdd->prepare('INSERT INTO file(user_name, file_name, groupe_name, description_file) VALUES(?,?,?,?)');
        $insert_file->execute(array($user_name, $file_name, $groupe_name, $description_file));
        
        $connection_ssh2 = ssh2_connect("localhost", 22);
        ssh2_auth_password($connection_ssh2, "mm", "azerty1234");
        ssh2_exec($connection_ssh2, "chmod 777 /var/www/html/Shared-Server-1/Web_new/public/stockage/users/$user_name/$file_name");

        return $insert_file;
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
        ssh2_exec($connection_ssh2, "mkdir /var/www/html/Shared-Server-1/Web_new/public/stockage/groupe/$name_new_groupe && chmod 777 /var/www/html/Shared-Server-1/Web_new/public/stockage/groupe/$name_new_groupe");
        return $create_groupe;
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
}
