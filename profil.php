<?php
session_start();
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
	?>
	<?php
	$stmt = $bdd->prepare("SELECT * FROM user INNER JOIN participer ON user.id_user = participer.id_user INNER JOIN cursus ON cursus.id_cursus = participer.id_cursus WHERE user.id_user = :id_user");
	$stmt->bindParam(":id_user", $_SESSION['id_user']);
	$stmt->execute();
	$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
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

	<section class="d-flex justify-content-end">
		<a href="edit-profil.php" class="btn btn-primary py-2 px-4">
			<svg height="16" viewBox="0 0 8 8" width="16" fill="white	" xmlns="http://www.w3.org/2000/svg">
				<path d="m6 0-1 1 2 2 1-1zm-2 2-4 4v2h2l4-4z"/>
			</svg>
			Éditer
		</a>
	</section>
	<section class="row">
		<section class="col-12 col-xl-6">
			<label for="mail_user">Adresse mail :</label>
			<input type="text" value="<?= $user_data['mail_user'] ?>" id="mail_user" class="form-control" disabled>
		</section>
		<section class="col-12 col-xl-6">
			<label for="dtn_user">Date de naissance :</label>
			<input type="text" value="<?= $user_data['dtn_user'] ?>" id="dtn_user" class="form-control" disabled>
		</section>
	</section>
	<section class="row">
		<section class="col-12 col-xl-6">
			<label for="mail_user">Ecole :</label>
			<input type="text" value="<?= $user_data['mail_user'] ?>" id="mail_user" class="form-control" disabled>
		</section>
		<section class="col-12 col-xl-6">
			<label for="libelle_cursus">Niveau d'études :</label>
			<input type="text" value="<?= $user_data['libelle_cursus'] ?>" id="libelle_cursus" class="form-control" disabled>
		</section>
	</section>

	<?php include "include/footer.php"; ?>
</body>
</html>
