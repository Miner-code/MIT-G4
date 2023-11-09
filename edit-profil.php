<?php
include "include/is-connected.php";

// Inclure le code de connexion à la base de données
include "include/bdd.php";

// Vérifier si une nouvelle photo a été téléchargée
if(isset($_FILES['img_user']) && $_FILES['img_user']['error'] == UPLOAD_ERR_OK){
    $uploadDir = "upload/user/"; // Dossier où vous stockerez les photos
    $uploadFile = $uploadDir . basename($_FILES['img_user']['name']);
    $tmp_img = $_FILES['img_user']['tmp_name'];
    move_uploaded_file($tmp_img, $uploadFile);

    // Déplacer le fichier téléchargé vers le dossier d'upload
    if (move_uploaded_file($tmp_img, $uploadFile)) {
        // Mettre à jour le chemin de la dans la base de données
        $stmt = $bdd->prepare("UPDATE user SET img_user = img_user WHERE id_user = :id_user");
        $stmt->bindParam(":img_user", $uploadFile);
        $stmt->bindParam(":id_user", $_SESSION['id_user']);
        $stmt->execute();
    }
}


//Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $newMail = $_POST['mail_user'];
    $newDtn = $_POST['dtn_user'];
    $id_etab = $_POST['id_etab'];
    $id_cursus = $_POST['id_cursus'];


    // Mettre à jour les données dans la base de données
    $stmt = $bdd->prepare("UPDATE user SET mail_user = :newMail, dtn_user = :newDtn WHERE user.id_user = :id_user");
    $stmt->bindParam(":newMail", $newMail);
    $stmt->bindParam(":newDtn", $newDtn);
    $stmt->bindParam(":id_user", $_SESSION['id_user']);
    $stmt->execute();

    $stmt = $bdd->prepare("UPDATE participer SET id_etab = :id_etab, id_cursus = :id_cursus WHERE id_user = :id_user");
    $stmt->bindParam(":id_etab", $id_etab);
    $stmt->bindParam(":id_cursus", $id_cursus);
    $stmt->bindParam(":id_user", $_SESSION['id_user']);
    $stmt->execute();

    // Rediriger l'utilisateur vers la page de profil
    header("Location: profil.php?id=".$_SESSION['id_user']);
}

// Récupérer les données de l'utilisateur
$stmt = $bdd->prepare("SELECT * FROM user INNER JOIN participer ON user.id_user = participer.id_user INNER JOIN cursus ON cursus.id_cursus = participer.id_cursus INNER JOIN etablissement ON participer.id_etab = etablissement.id_etab WHERE user.id_user = :id_user");
$stmt->bindParam(":id_user", $_SESSION['id_user']);
$stmt->execute();
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $bdd->prepare("SELECT * FROM etablissement INNER JOIN ville ON etablissement.id_ville = ville.id_ville");
$stmt->execute();   
$etab_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $bdd->prepare("SELECT * FROM cursus");
$stmt->execute();
$cursus_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Unea.com - Modifier le profil</title>
  <?php include "include/head.php"; ?>
</head>

<body>
  <?php include "include/nav.php"; ?>

  <form method="post" enctype="multipart/form-data">
    <section class="d-flex flex-row align-items-center">
      <img class="rounded-circle" src="<?=$user_data['img_user']?>" alt="Photo de profil" style="width: 5em; height: 5em;">
      <h2 class="ms-5"><?= $user_data['prenom_user'] . ' ' . $user_data['nom_user'] ?></h2>
    </section>

    <section>
      <div class="form-group mb-5">
        <label for="img_user">Nouvelle photo de profil :</label>
        <input type="file" id="img_user" name="img_user" accept="image/*">
      </div>
    </section>
  <section class="row">
    <section class="col-12 col-xl-6">
      <div class="form-group mb-5">
        <label for="mail_user">Adresse mail :</label>
        <input type="email" value="<?= $user_data['mail_user'] ?>" id="mail_user" name="mail_user"
          class="form-control" required>
      </div>
      <div class="form-group mb-5">
        <label for="dtn_user">Date de naissance :</label>
        <input type="text" value="<?= $user_data['dtn_user'] ?>" id="dtn_user" name="dtn_user"
          class="form-control" required>
      </div>
    </section>

    <section class="col-12 col-xl-6">
      <div class="form-group mb-5">
        <label for="id_etab">Ecole :</label>
        <select name="id_etab" id="id_etab" class="form-control">
          <?php foreach ($etab_data as $etab) {
            echo '<option value="' . $etab['id_etab'] . '">' . $etab['nom_etab'] . ' - ' .
              $etab['nom_ville'] . '</option>';
          } ?>
        </select>
      </div>
      <div class="form-group mb-5">
        <label for="id_cursus">Niveau d'études :</label>
        <select name="id_cursus" id="id_cursus" class="form-control">
          <?php foreach ($cursus_data as $cursus) {
            echo '<option value="' . $cursus['id_cursus'] . '">' . $cursus['libelle_cursus'] . '</option>';
          } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary py-2 px-4">Mettre à jour le profil</button>
    </section>
    
  </section>
  </form>

  <?php include "include/footer.php"; ?>
</body>

</html>