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

	<h1 class="text-center">Mon profil</h1>
	<div class="row">
		<div class="col">
			<table class="table">
				<tbody>
					<tr>
						<td class="fs-4">Prénom</td>
						<td class="fs-4"><?php echo $user_data['prenom_user']; ?></td>
					</tr>
					<tr>
						<td class="fs-4">Nom</td>
						<td class="fs-4"><?php echo $user_data['nom_user']; ?></td>
					</tr>
					<tr>
						<td class="fs-4">Email</td>
						<td class="fs-4"><?php echo $user_data['mail_user']; ?></td>
					</tr>
					<tr>
						<td class="fs-4">Date de naissance</td>
						<td class="fs-4"><?php echo $user_data['dtn_user']; ?></td>
					</tr>
					<tr>
						<td class="fs-4">Niveau d'études</td>
						<td class="fs-4"><?php echo $user_data['libelle_cursus']; ?></td>
					</tr>
				</tbody>
			</table>
			<a href="edit-profil.php" class="btn btn-primary">Éditer</a>
		</div>
	</div>

	<?php include "include/footer.php"; ?>
</body>
</html>
