<?php include "include/is-connected.php"; 
if(!isset($_GET['id'])){
	header("Location: index.html");
}else{
$id = $_GET["id"];
//echo $id;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Unea.com</title>
  <?php include "include/head.php"; ?>
</head>

<body>
  <?php
    include "include/bdd.php";
    include "include/nav.php";

    $stmt = $bdd->prepare("SELECT * FROM user INNER JOIN participer ON user.id_user = participer.id_user INNER JOIN cursus ON cursus.id_cursus = participer.id_cursus INNER JOIN etablissement ON participer.id_etab = etablissement.id_etab WHERE user.id_user = :id_user");
    $stmt->bindParam(":id_user", $_GET['id']);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>

  <section class="d-flex justify-content-between">
    <section class="d-flex flex-row align-items-center">
      <img class="rounded-circle" src="<?=$user_data['img_user']?>" alt="Photo de profil" style="width: 5em; height: 5em;">
      <h2 class="ms-5"><?= $user_data['prenom_user'] . ' ' . $user_data['nom_user'] ?></h2>
    </section>
  </section>

  <?php
    if (isset($_GET['id']) && $_GET['id'] == $_SESSION['id_user']) {
      echo '<section class="d-flex justify-content-end">';
      echo '<a href="edit-profil.php" class="btn btn-primary py-2 px-4">';
      echo '<svg height="16" viewBox="0 0 8 8" width="16" fill="white " xmlns="http://www.w3.org/2000/svg">';
      echo '<path d="m6 0-1 1 2 2 1-1zm-2 2-4 4v2h2l4-4z"/></svg> Éditer </a>';
      echo '</section>';
    }
  ?>

  <section class="row">
    <section class="col-12 col-xl-6">
    <div class="form-group mb-5">
      <label for="mail_user">Adresse mail :</label>
      <input type="text" value="<?= $user_data['mail_user'] ?>" id="mail_user" class="form-control" disabled>
    </div>
    </section>
    <section class="col-12 col-xl-6">
    <div class="form-group mb-5">
      <label for="dtn_user">Date de naissance :</label>
      <input type="text" value="<?= $user_data['dtn_user'] ?>" id="dtn_user" class="form-control" disabled>
    </div>
    </section>
  </section>

  <section class="row">
    <section class="col-12 col-xl-6">
    <div class="form-group mb-5">
      <label for="nom_etab">Ecole :</label>
      <input type="text" value="<?= $user_data['nom_etab'] ?>" id="nom_etab" class="form-control" disabled>
    </div>
    </section>
    <section class="col-12 col-xl-6">
    <div class="form-group mb-5">
      <label for="libelle_cursus">Niveau d'études :</label>
      <input type="text" value="<?= $user_data['libelle_cursus'] ?>" id="libelle_cursus" class="form-control" disabled>
    </div>
    </section>
  </section>

  <?php include "include/footer.php"; ?>
</body>

</html>
