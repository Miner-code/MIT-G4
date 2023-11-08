<?php
include "include/is-connected.php";
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
	
			if (!isset($_GET['id_impression'])) {
				header('location: index.php');
			} else {
				$req = $bdd->prepare("SELECT * FROM impression WHERE id_imp =  ".$_GET['id_impression']);
				$req->execute();
				$dataImpression = $req->fetch(PDO::FETCH_ASSOC);
				var_dump($dataImpression);

				$req = $bdd->prepare("SELECT * FROM user WHERE id_user = ".$dataImpression['id_user']);
				$req->execute();
				$dataUser = $req->fetch(PDO::FETCH_ASSOC);
				// var_dump($dataUser);

				$req = $bdd->prepare("SELECT * FROM commentaire WHERE id_imp = ".$dataImpression['id_imp']);
				$req->execute();
				$dataComm = $req->fetchAll(PDO::FETCH_ASSOC);
				// var_dump($dataComm);
			}

			if ($_SESSION['id_user'] == $dataImpression['id_user']) {
		?>
		<section class="d-flex justify-content-end w-100 mb-3">
			<button class="btn btn-primary">
				modifier
			</button>
		</section>
			<?php } ?>
		<section class="d-flex flex-column">
			<section class="card p-2">
				<section class="d-flex flex-row justify-content-between align-items-center">
					<section class="rounded-circle p-3 bg-grey">
						<svg height="36" viewBox="0 0 8 8" width="36" xmlns="http://www.w3.org/2000/svg">
							<path d="m4 0c-1.1 0-2 1.12-2 2.5s.9 2.5 2 2.5 2-1.12 2-2.5-.9-2.5-2-2.5zm-2.09 5c-1.06.05-1.91.92-1.91 2v1h8v-1c0-1.08-.84-1.95-1.91-2-.54.61-1.28 1-2.09 1s-1.55-.39-2.09-1z"/>
						</svg>
					</section>
					<h3 class="border-bottom border-dark"><?= $dataImpression['titre_imp'] ?></h3>
					<span style="width: calc(36px + 1rem)"></span>
				</section>
				<section class="row">
					<section class="col-2"></section>
					<p class="col-8">
						<?= $dataImpression['contenu_imp'] ?>
					</p>
					<section class="col-2"></section>
				</section>
				<section class="d-flex justify-content-end w-100 mb-3 pe-3">
					<p><?= $dataUser['nom_user'].' '.$dataUser['prenom_user'].', '.$dataImpression['date_imp'] ?></p>
					<!-- utiliser diffDate avec des split pour separer date et heure -->
				</section>
			</section>
		</section>	
		<section class="d-flex flex-column">

			<?php
		for ($i=0; $i < count($dataComm); $i++) { 
			?>
			<section>
				<section class="d-flex flex-row justify-content-between align-items-center">
					<section class="d-flex flex-row align-items-center">
						<section class="rounded-circle p-2 bg-grey">
							<svg height="18" viewBox="0 0 8 8" width="18" xmlns="http://www.w3.org/2000/svg">
								<path d="m4 0c-1.1 0-2 1.12-2 2.5s.9 2.5 2 2.5 2-1.12 2-2.5-.9-2.5-2-2.5zm-2.09 5c-1.06.05-1.91.92-1.91 2v1h8v-1c0-1.08-.84-1.95-1.91-2-.54.61-1.28 1-2.09 1s-1.55-.39-2.09-1z"/>
							</svg>				
						</section>
						<h4 class="fs-6"><?= $dataUser['nom_user'].' '.$dataUser['prenom_user'] ?></h4>
					</section>
					<p><?= $dataComm[$i]['date_com'] ?></p>
					<!-- utiliser diffDate avec des split pour separer date et heure -->
				</section>
				<section class="mx-3">
					<?= $dataComm[$i]['contenu_com'] ?>
				</section>
			</section>

			<?php
		}
			?>
		</section>
		<?php require_once "include/footer.php"; ?>
	</body>
</html>