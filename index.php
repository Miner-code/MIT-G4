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
		
		<form method="post" action="traitement.php">
			<textarea name="message" placeholder="Que voulez-vous partager ?" rows="4" required></textarea>
			<button type="submit">Publier</button>
		</form>
		
		
		<?php include "include/footer.php"; ?>
	</body>
</html>