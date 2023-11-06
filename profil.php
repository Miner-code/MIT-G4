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

		<div class="container">
			<h1>Mon profil</h1>
			<table class="table">
				<thead>
					<tr>
						<th>Prénom</th>
						<th>Nom</th>
						<th>Email</th>
						<th>Date de naissance</th>
						<th>Niveau d'études</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt = $bdd->prepare("SELECT * FROM user INNER JOIN participer ON user.id_user = participer.id_user INNER JOIN cursus ON cursus.id_cursus = participer.id_cursus WHERE user.id_user = :id_user");
					$stmt->bindParam(":id_user", $_SESSION['id_user']);
					$stmt->execute();
					while ($user_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<tr>
							<td><?php echo $user_data['nom_user']; ?></td>
							<td><?php echo $user_data['prenom_user']; ?></td>
							<td><?php echo $user_data['mail_user']; ?></td>
							<td><?php echo $user_data['dtn_user']; ?></td>
							<td><?php echo $user_data['libelle_cursus']; ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>

		<?php include "include/footer.php"; ?>
	</body>
</html>