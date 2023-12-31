<?php
$mes_error = '';
if (isset($_POST['submit'])){
    $validation = True;

    $nom_user = $_POST['nom'];
    $prenom_user = $_POST['prenom'];
    $mail_user = $_POST['mail'];
    $dtn_user = $_POST['dtn'];
    $id_cursus = $_POST['id_cursus'];
    $date_debut = $_POST['date_debut'];
    if (isset($_POST['date_fin'])) {
        $date_fin = $_POST['date_fin'];
    } else {
        $date_fin = null;
    }
    if (isset($_POST['newsLetter'])) {
        $newsLetter = 1;
    } else {
        $newsLetter = 0;
    }
    $id_etab = $_POST['id_etab'];

    if ($id_etab === 'null') {
        $nom_etab = $_POST['nom_etab'];
        $adresse_etab = $_POST['adresse_etab'];
        $nom_ville = $_POST['nom_ville'];
        $cp_ville = $_POST['cp_ville'];
    }

    if (isset($_POST['date_fin'])) {
        $date_fin = $_POST['date_fin'];
    }

    //* Vérification des doublons d'adresse mail
    $req = $bdd->prepare("SELECT * FROM user WHERE mail_user = '$mail_user'");
    $req->execute();
    $result = $req->rowCount();
    if($result > 0){ $validation = False; $mes_error = '<br/>Cette adresse mail est déjà utilisé.'; }

    if($_POST['password1'] != $_POST['password2']){ $validation = False; $mes_error = '<br/>Les mots de passe ne corresponde pas.'; }

    if($validation == True){
        //* Si il ni a pas d'image
        $chemin_image = 'upload/user/defaut.png';
        $mdp_user = hash('sha256', $_POST['password1']);
        
        //* Ajout bdd
        $req = $bdd->prepare("INSERT INTO user (nom_user, prenom_user, mail_user, dtn_user, mdp_user, img_user, role_user, newsLetter) 
            VALUES (:nom_user, :prenom_user, :mail_user, :dtn_user, :mdp_user, :img_user, 0, :newsLetter)");
        $req->bindValue(':nom_user', $nom_user);
        $req->bindValue(':prenom_user', $prenom_user);
        $req->bindValue(':mail_user', $mail_user);
        $req->bindValue(':dtn_user', $dtn_user);
        $req->bindValue(':mdp_user', $mdp_user);
        $req->bindValue(':img_user', $chemin_image);
        $req->bindValue(':newsLetter', $newsLetter);
        $req->execute();
        $id_user = $bdd->lastInsertId();

        if ($id_etab === 'null') {
            $req = $bdd->prepare("INSERT INTO ville (nom_ville, cp_ville) VALUES (:nom_ville, :cp_ville)");
            $req->bindValue(':nom_ville', $nom_ville);
            $req->bindValue(':cp_ville', $cp_ville);
            $req->execute();

            $id_ville = $bdd->lastInsertId();

            $req = $bdd->prepare("INSERT INTO etablissement (nom_etab , adresse_etab, id_ville) 
                VALUES (:nom_etab, :adresse_etab, :id_ville)");
            $req->bindValue(':nom_etab', $nom_etab);
            $req->bindValue(':adresse_etab', $adresse_etab);
            $req->bindValue(':id_ville', $id_ville);
            $req->execute();

            $id_etab = $bdd->lastInsertId();

            $req = $bdd->prepare("INSERT INTO participer (id_user, id_cursus, id_etab, date_debut, date_fin) 
                VALUES (:id_user, :id_cursus, :id_etab, :date_debut, :date_fin)");
            $req->bindValue(':id_user', $id_user);
            $req->bindValue(':id_cursus', $id_cursus);
            $req->bindValue(':id_etab', $id_etab);
            $req->bindValue(':date_debut', $date_debut);
            $req->bindValue(':date_fin', $date_fin);
            $req->execute();
            
        } else {
            $req = $bdd->prepare("INSERT INTO participer (id_user , id_cursus, id_etab, date_debut, date_fin) 
                VALUES (:id_user , :id_cursus, :id_etab, :date_debut, :date_fin)");
            $req->bindValue(':id_user', $id_user);
            $req->bindValue(':id_cursus', $id_cursus);
            $req->bindValue(':id_etab', $id_etab);
            $req->bindValue(':date_debut', $date_debut);
            $req->bindValue(':date_fin', $date_fin);
            $req->execute();
        }

        $req = $bdd->prepare("SELECT role_user FROM user WHERE id_user = $id_user");
        $req->execute();
        $role_user = $req->fetch(\PDO::FETCH_OBJ)->role_user;

        session_start();
        $_SESSION['id_user'] = intval($id_user);
        $_SESSION['role_user'] = intval($role_user);
        header("location:index.php");
    }
}

?>