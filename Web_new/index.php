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
                list_file($user_name);
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
    }
    else{
        
        page1();
    }
}
catch(Exception $e){
    echo "Erreur :".$e->getMessage();
}