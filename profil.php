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
    $stmt = $bdd->prepare("SELECT * FROM user WHERE id_user = :id_user");
    $stmt->bindParam(":id_user", $_SESSION['id_user']);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

		<?php include "include/footer.php"; ?>
	</body>
</html>