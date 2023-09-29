<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Unea.com</title>
	<?php include "includes/head.php"; ?>
</head>
	<body>
		<?php 
		include "includes/bdd.php";
		include "includes/nav.php";
		?>
		
		<form method="post" action="traitement.php">
			<textarea name="message" placeholder="Que voulez-vous partager ?" rows="4" required></textarea>
			<button type="submit">Publier</button>
		</form>
		
		
		<?php include "includes/footer.php"; ?>
	</body>
</html>