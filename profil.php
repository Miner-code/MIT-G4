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
					$stmt = $bdd->prepare("SELECT * FROM user WHERE id_user = :id_user");
					$stmt->bindParam(":id_user", $_SESSION['id_user']);
					$stmt->execute();
					while ($user_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<tr>
							<td><?php echo $user_data['firstname']; ?></td>
							<td><?php echo $user_data['lastname']; ?></td>
							<td><?php echo $user_data['email']; ?></td>
							<td><?php echo $user_data['birthdate']; ?></td>
							<td><?php echo $user_data['study']; ?></td>
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