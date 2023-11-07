<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Unea.com - Modifier le profil</title>
	<?php include "include/head.php"; ?>
</head>
<body>
	<?php 
	include "include/bdd.php";
	include "include/nav.php";
	?>

	<div class="container">
		<h1>Modifier le profil</h1>
		<?php
		if (isset($_POST['update_profile'])) {
			// Code pour mettre à jour le profil ici
			// Vous devez ajouter la logique de mise à jour des informations de l'utilisateur
		}
		?>

		<form method="post">
			<table class="table">
				<tbody>
					<?php
					$stmt = $bdd->prepare("SELECT * FROM user INNER JOIN participer ON user.id_user = participer.id_user INNER JOIN cursus ON cursus.id_cursus = participer.id_cursus WHERE user.id_user = :id_user");
					$stmt->bindParam(":id_user", $_SESSION['id_user']);
					$stmt->execute();
					while ($user_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
						?>
						<tr>
							<td class="fs-4">Prénom</td>
							<td class="fs-4"><input type="text" name="prenom_user" value="<?php echo $user_data['prenom_user']; ?>"></td>
						</tr>
						<tr>
							<td class="fs-4">Nom</td>
							<td class="fs-4"><input type="text" name="nom_user" value="<?php echo $user_data['nom_user']; ?>"></td>
						</tr>
						<tr>
							<td class="fs-4">Email</td>
							<td class="fs-4"><input type="email" name="mail_user" value="<?php echo $user_data['mail_user']; ?>"></td>
						</tr>
						<tr>
							<td class="fs-4">Date de naissance</td>
							<td class="fs-4"><input type="text" name="dtn_user" value="<?php echo $user_data['dtn_user']; ?>"></td>
						</tr>
						<tr>
							<td class="fs-4">Niveau d'études</td>
							<td class="fs-4">
								<select name="cursus">
									<option value="<?php echo $user_data['id_cursus']; ?>"><?php echo $user_data['libelle_cursus']; ?></option>
									<!-- Vous devez charger la liste des cursus disponibles ici -->
								</select>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<button type="submit" name="update_profile" class="btn btn-primary">Mettre à jour le profil</button>
		</form>
	</div>

	<?php include "include/footer.php"; ?>
</body>
</html>
