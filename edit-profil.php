<?php
include "include/is-connected.php";

// Inclure le code de connexion à la base de données
include "include/bdd.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $newMail = $_POST['mail_user'];
    $newDtn = $_POST['dtn_user'];

    // Mettre à jour les données dans la base de données
    $stmt = $bdd->prepare("UPDATE user SET mail_user = :newMail, dtn_user = :newDtn WHERE id_user = :id_user");
    $stmt->bindParam(":newMail", $newMail);
    $stmt->bindParam(":newDtn", $newDtn);
    $stmt->bindParam(":id_user", $_SESSION['id_user']);
    $stmt->execute();

    // Rediriger l'utilisateur vers la page de profil
    header("Location: profil.php");
    exit;
}

// Récupérer les données de l'utilisateur
$stmt = $bdd->prepare("SELECT * FROM user INNER JOIN participer ON user.id_user = participer.id_user INNER JOIN cursus ON cursus.id_cursus = participer.id_cursus WHERE user.id_user = :id_user");
$stmt->bindParam(":id_user", $_SESSION['id_user']);
$stmt->execute();
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Unea.com - Modifier le profil</title>
    <?php include "include/head.php"; ?>
</head>
<body>
    <?php 
    include "include/nav.php";
    ?>

    <section class="d-flex justify-content-between">
        <section class="rounded-circle p-3 bg-grey">
            <svg height="36" viewBox="0 0 8 8" width="36" xmlns="http://www.w3.org/2000/svg">
                <path d="m4 0c-1.1 0-2 1.12-2 2.5s.9 2.5 2 2.5 2-1.12 2-2.5-.9-2.5-2-2.5zm-2.09 5c-1.06.05-1.91.92-1.91 2v1h8v-1c0-1.08-.84-1.95-1.91-2-.54.61-1.28 1-2.09 1s-1.55-.39-2.09-1z"/>
            </svg>
        </section>
        <h2><?= $user_data['prenom_user'].' '.$user_data['nom_user'] ?></h2>
        <span style="width: calc(36px + 1rem)"></span>
        <span style="width: calc(36px + 1rem)"></span>
    </section>

    <section class="row">
        <section class="col-12 col-xl-6">
            <form method="post">
                <label for="mail_user">Adresse mail :</label>
                <input type="text" value="<?= $user_data['mail_user'] ?>" id="mail_user" name="mail_user" class="form-control" abled>
                
                <label for="dtn_user">Date de naissance :</label>
                <input type="text" value="<?= $user_data['dtn_user'] ?>" id="dtn_user" name="dtn_user" class="form-control" disabled>
                
                <button type="submit" class="btn btn-primary py-2 px-4">Mettre à jour le profil</button>
            </form>
        </section>

        <section class="col-12 col-xl-6">
            <label for="mail_user">Ecole :</label>
            <input type="text" value="<?= $user_data['mail_user'] ?>" id="mail_user" class="form-control" abled>
            
            <label for="libelle_cursus">Niveau d'études :</label>
            <input type="text" value="<?= $user_data['libelle_cursus'] ?>" id="libelle_cursus" class="form-control" abled>
        </section>
    </section>

    <?php include "include/footer.php"; ?>
</body>
</html>
