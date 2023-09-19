<?php
    session_start();
    if(empty($_SESSION['grade'])){
        header('location:index.php');
        exit();
    }
    if($_SESSION['grade'] != 'admin'){
        header('location:index.php');
        exit();
    }else{

        include "includes/bdd.php";
    
        if (isset($_GET["id"])) {
            if (isset($_GET["etat"])) {
    
                $id = $_GET["id"];
                $etat = $_GET["etat"];
                if($etat == 'valid'){
                    // Valid devient banni
                    $req = $bdd->prepare("UPDATE user SET etat='banni' WHERE id = '$id'");
                    $req->execute();
                }
                if($etat == 'attValid'){
                    // Attente de validation devient valid
                    $req = $bdd->prepare("UPDATE user SET etat='valid' WHERE id = '$id'");
                    $req->execute();
                }
                if($etat == 'banni'){
                    // Banni devient valid
                    $req = $bdd->prepare("UPDATE user SET etat='valid' WHERE id = '$id'");
                    $req->execute();
                }
                header("location:gestion-utilisateur.php");
            }
        }
    }
?>