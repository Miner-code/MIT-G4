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
		
		<div class="messages">
    <?php
    $id_etab = 1; // Replace with the current establishment's ID

    // Select messages for the specified establishment
    $sql = "SELECT * FROM impression WHERE id_theme = :id_etab ORDER BY date_imp DESC";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":id_etab", $id_etab);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        echo "<div class='message'>";
        echo "<h3>{$message['titre_imp']}</h3>";
        echo "<p>{$message['contenu_imp']}</p>";
        echo "<p>Published on {$message['date_imp']}</p>";
        echo "</div>";
    }
    ?>
</div>

		
		<?php include "include/footer.php"; ?>
	</body>
</html>