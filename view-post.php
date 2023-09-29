<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>A CHANGER</title>
	<?php require_once "include/head.php"; ?>
</head>
	<body>
		<?php 
			require_once "include/bdd.php";
			require_once "include/nav.php";
	
			if (!isset($_GET['id'])) {
				header('location: index.php');
			} else {
				$idImpression = $_GET['id_impression'];
				$req = $bdd->prepare("SELECT * FROM impression WHERE id_imp = $idImpression");
				$req->execute();
				$dataImpression = $req->fetchAll(PDO::FETCH_ASSOC);
				var_dump($dataImpression);

				foreach ($dataImpression as $row) {
				 	echo $row
				}

				$req = $bdd->prepare("SELECT * FROM user WHERE id_user = $dataImpression['id_user']");
				$req->execute();
				$dataUser = $req->fetchAll(PDO::FETCH_ASSOC);
				var_dump($dataUser);

				foreach ($dataUser as $row) {
				 	echo $row
				}
			}
		?>
		<?php require_once "include/footer.php"; ?>
	</body>
</html>