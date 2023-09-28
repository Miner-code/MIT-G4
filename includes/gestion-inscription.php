<?php
$mes_error = '';
if (isset($_POST['submit'])){

    $validation = True;

    $nom_user = $_POST['nom'];
    $prenom_user = $_POST['prenom'];
    $mail_user = $_POST['mail'];
    $dtn_user = $_POST['dtn'];
    $num_cursus = $_POST['num_cursus'];
    $date_obtention = $_POST['date_obtention'];
    $num_etab = $_POST['num_etab'];
    if ($num_etab === 'null') {
        $nom_etab = $_POST['nom_etab'];
        $adresse_etab = $_POST['adresse_etab'];
        $nom_ville = $_POST['nom_ville'];
        $cp_ville = $_POST['cp_ville'];
    }


    if (isset($_POST['date_obtention'])) {
        $date_obtention = $_POST['date_obtention'];
    }

    //* Vérification des doublons d'adresse mail
    $req = $bdd->prepare("SELECT * FROM user WHERE mail = '$mail'");
    $req->execute();
    $result = $req->rowCount();
    if($result > 0){ $validation = False; $mes_error = '<br/>Cette adresse mail est déjà utilisé.'; }

    if($_POST['password1'] != $_POST['password2']){ $validation = False; $mes_error = '<br/>Les mots de passe ne corresponde pas.'; }

    if($validation == True){
    //* Si il ni a pas d'image
        $chemin_image = 'upload/user/defaut.png';
    //* Sinon
        if($_FILES['img_profil']['name'] == ''){
        //* Renommage de l'image et ajout du chemin
            $file_name = $_FILES['img_profil']['name'];
            $ext_img = ".".strtolower(substr(strrchr($file_name, "."), 1));
            $chemin_image = "upload/user/".$nom_user.'-'.$prenom_user.$ext_img;
            $tmp_img = $_FILES['img_profil']['tmp_name'];
            move_uploaded_file($tmp_img, $chemin_image);
        }
// ! CHANGER sha1
        $mdp_user = sha1($_POST['password1']);   

        //* Ajout bdd
        $req = $bdd->prepare("INSERT INTO user (nom_user, prenom_user, mail_user, dtn_user, mdp_user, img_user) 
                            VALUES (:nom_user, :prenom_user, :mail_user, :dtn_user, :mdp_user, :img_user)");

                            // ! REQUETE A FAIRE
        $req->bindValue(':nom_user', $nom_user);
        $req->bindValue(':prenom_user', $prenom_user);
        $req->bindValue(':mail_user', $mail_user);
        $req->bindValue(':dtn_user', $dtn_user);
        $req->bindValue(':mdp_user', $mdp_user);
        $req->bindValue(':img_user', $img_user);
        $req->execute();

        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['id'] = $mail;
        header("location:index.php");
    }
}

?>