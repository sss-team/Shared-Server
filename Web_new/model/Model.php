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
        return $insertion_info;
    }

    public function post_files($user_name){
        $bdd = $this->dbconnect();
        $files = $bdd->prepare("SELECT * FROM file WHERE user_name=?");
        $files->execute(array($user_name));
        return $files;
    }

    public function user_names(){
        $bdd = $this->dbconnect();
        $all_user_names = $bdd->prepare("SELECT user_name FROM membre");
        $all_user_names->execute();
        return $all_user_names;
    }
}
