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
		
		<div class="messages">
    <?php
    $id_entreprise = 1; // Remplacez par l'ID de l'entreprise actuelle

    // Sélectionnez les messages de l'entreprise spécifiée
    $sql = "SELECT * FROM impressions WHERE num_1 = :id_entreprise ORDER BY num_date DESC";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":id_entreprise", $id_entreprise);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        echo "<div class='message'>";
        echo "<h3>{$message['titre']}</h3>";
        echo "<p>{$message['contenu']}</p>";
        echo "<p>Publié le {$message['num_date']}</p>";
        echo "</div>";
    }
    ?>
</div>
		
		<?php include "includes/footer.php"; ?>
	</body>
</html>