<?php
session_start();
$id_proprietaire = $_SESSION["id"];
$ajouter = 0;
$suppr = 0;
$bdd = new PDO('mysql:host=localhost;dbname=bdd_sserver','sserver','sserver') or die("not connect");
if(isset($_POST['créer_groupe']))
{
        $name_new_groupe = $_POST['name_new_groupe'];
        if($_POST['ajouter']=='on')
        {
            $ajouter = 1;
        }
        if($_POST['suppr']=='on')
        {
            $suppr = 1;
        }

    $insert_groupe = $bdd->prepare("INSERT INTO groupe(name_groupe, droit_ajouter, droit_suppr) VALUES(?,?,?)");
    $insert_groupe->execute(array($name_new_groupe, $ajouter, $suppr));
    

    $id_groupe = $bdd->query("SELECT id_groupe from groupe WHERE name_groupe='$name_new_groupe'");
    $exixta = $id_groupe->rowCount();
    if($exixta==1){
        $id_groupe = $id_groupe->fetch();
        $id_groupe = $id_groupe['id_groupe'];
    }
    echo $id_groupe;
    echo $id_proprietaire;

    $insert_les_id_relation = $bdd->prepare("INSERT INTO Groupe_membre(id_groupe, id) VALUES(?, ?)");
    $insert_les_id_relation->execute(array($id_groupe, $id_proprietaire));
}
header("Location: test.php?id=".$_SESSION['id']);
?>