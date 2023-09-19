<?php
$mes_error = '';
if (isset($_POST['submit'])){

    $validation = True;

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $grade = $_POST['grade'];
    $pseudo = $_POST['pseudo'];
    $siret = '';
    

    if(strlen($nom) < 3 && strlen($nom) > 15){ $validation = False; }

    if(strlen($prenom) < 3 && strlen($prenom) > 15){ $validation = False; }

    if(strlen($pseudo) < 3 && strlen($pseudo) > 15){ $validation = False; }

    if(filter_var($mail, FILTER_VALIDATE_EMAIL) == False) { $validation = False; }

    if($grade != 'photographe' && $grade != 'client'){ $validation = False; }

    //* Vérification des doublons d'adresse mail
    $req = $bdd->prepare("SELECT * FROM user WHERE mail = '$mail'");
    $req->execute();
    $result = $req->rowCount();
    if($result > 0){ $validation = False; $mes_error = '<br/>Cette adresse mail est déjà utilisé.'; }

    //* Vérification des doublons de pseudo
    $req = $bdd->prepare("SELECT * FROM user WHERE pseudo = '$pseudo'");
    $req->execute();
    $result = $req->rowCount();
    if($result > 0){ $validation = False; $mes_error = '<br/>Ce pseudo est déjà utilisé.'; }

    //* Vérification des doublons de num SIRET
    if(!empty($_POST['siret'])){ 
        $siret = $_POST['siret']; 

        $req = $bdd->prepare("SELECT * FROM user WHERE SIRET = '$siret'");
        $req->execute();
        $result = $req->rowCount();
        if($result > 0){ $validation = False; $mes_error = '<br/>Ce numéro de SIRET est déjà utilisé.'; }
    }

    if($_POST['password1'] != $_POST['password2']){ $validation = False; $mes_error = '<br/>Les mots de passe ne corresponde pas.'; }

    if($validation == True){
    //* Si il ni a pas d'image
        $chemin_image = 'upload/user/defaut.png';
    //* Sinon
        if($_FILES['img_profil']['name'] == ''){
        //* Renommage de l'image et ajout du chemin
            $file_name = $_FILES['img_profil']['name'];
            $ext_img = ".".strtolower(substr(strrchr($file_name, "."), 1));
            $chemin_image = "upload/user/".$pseudo.$ext_img;
            $tmp_img = $_FILES['img_profil']['tmp_name'];
            move_uploaded_file($tmp_img, $chemin_image);
        }

        $mdp = sha1($_POST['password1']);   
        //* Si le comte est photographe il faut une validation de l'admin
        if($grade == 'photographe'){
            $etat = 'attValid';
        }
        if($grade == 'client'){
            $etat = 'valid';
        }
        //* Ajout bdd
        $req = $bdd->prepare("INSERT INTO user (nom, prenom, pseudo, img_profil, mail, mdp, grade, SIRET, etat) 
                            VALUES (:nom, :prenom, :pseudo, :img_profil, :mail, :mdp, :grade, :siret, :etat)");
        $req->bindValue(':nom', $nom);
        $req->bindValue(':prenom', $prenom);
        $req->bindValue(':pseudo', $pseudo);
        $req->bindValue(':img_profil', $chemin_image);
        $req->bindValue(':mail', $mail);
        $req->bindValue(':mdp', $mdp);
        $req->bindValue(':grade', $grade);
        $req->bindValue(':siret', $siret);
        $req->bindValue(':etat', $etat);
        $req->execute();

        if($etat == 'valid'){
            session_start();
            $_SESSION['grade'] = $grade;
            $_SESSION['mail'] = $mail;
            $_SESSION['pseudo'] = $pseudo;
            header("location:index.php");
        }else{
            //* pour remettre à 0 les input
            $nom = '';
            $prenom = '';
            $mail = '';
            $grade = '';
            $pseudo = '';
            $siret = '';
            $mes_error = 'Votre compte est en attente de validation.';
        }
    }
}

?>