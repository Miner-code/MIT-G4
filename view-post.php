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
			require_once "function/difDate.php";
			if (!isset($_GET['id_impression'])) {
				header('location: index.php');
			} else {
				$req = $bdd->prepare("SELECT * FROM impression WHERE id_imp =  ".$_GET['id_impression']);
				$req->execute();
				$dataImpression = $req->fetch(PDO::FETCH_ASSOC);
				//var_dump($dataImpression);
				$req = $bdd->prepare("SELECT * FROM user WHERE id_user = ".$dataImpression['id_user']);
				$req->execute();
				$dataUser = $req->fetch(PDO::FETCH_ASSOC);
				// var_dump($dataUser);
				$req = $bdd->prepare("SELECT * FROM commentaire WHERE id_imp = ".$dataImpression['id_imp']);
				$req->execute();
				$dataComm = $req->fetchAll(PDO::FETCH_ASSOC);
				// var_dump($dataComm);
				$req = $bdd->prepare("SELECT * FROM etablissement JOIN participer ON etablissement.id_etab = participer.id_etab JOIN user ON user.id_user = participer.id_user WHERE user.id_user = " . $dataUser['id_user']);
				$req->execute();
				$dataEtab = $req->fetch(PDO::FETCH_ASSOC);
				//var_dump($dataEtab);
			}
			if (isset($_POST['submit'])) {
				if (isset($_POST["textAreaComm"])) {
					$nomCom = htmlspecialchars($_POST["textAreaComm"]);
					$date_com = date("y-m-d H:i:s");
					
					$id_imp = $dataImpression['id_imp'];
	
					$req = $bdd->prepare("INSERT INTO commentaire(contenu_com, date_com, id_imp) VALUES (:nomCom, :date_com, :id_imp);");
					$req->bindValue(':nomCom', $nomCom);
					$req->bindValue(':date_com', $date_com);
					$req->bindValue(':id_imp', $id_imp);
					$req->execute();
					header('Location: ' . $_SERVER['PHP_SELF'].'id_impression='.$_GET['id_impression']);
    				exit;
				}
			}
			
			require_once "include/nav.php";
			if ($_SESSION['id_user'] == $dataImpression['id_user']) {
		?>
			<section class="d-flex justify-content-end w-100 mb-3">
				<a href="edit-post.php?id_impression=<?=$_GET['id_impression']?>" class="btn btn-primary" > 
					modifier
				</a>
			</section>
				<?php } ?>
			<section class="mx-adapt">
				<section class="d-flex flex-column">
					<section class="card p-2 rounded-textarea">
						<section class="d-flex flex-row justify-content-between align-items-center">
							<section class="rounded-circle p-3 width=36 height=36">
								<img src="<?= $dataEtab['profil_etab'] ?>" class="img-reduce img-rounded"/>
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
							<?= $dataUser['nom_user'].' '.$dataUser['prenom_user'].', '.publieDepuis($dataImpression['date_imp']) ?></p>
						</section>
					</section>
				</section>
				<form method="POST" class="rounded-textarea d-flex justify-content-between mb-3">
					<textarea id="textAreaComm" name="textAreaComm" rows="4" placeholder="Répondre..."></textarea>
					<section class="d-flex align-items-center justify-content-end w-5 h-5 mb-2">
						<button type="submit" name="submit" class="btn btn-primary mx-2 my-3 btn-sqr">
							<svg class="align-items-center" fill="white" viewBox="0 0 16 16" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
								<path d="m16 1-1-1-15 6v2l7 1 1 7h2z"></path>
							</svg>
						</button>
					</section>
				</form>
				<section class="d-flex flex-column">

					<?php
						for ($i=0; $i < count($dataComm); $i++) { 	
					?>
					<section>
						<section class="d-flex flex-row justify-content-between align-items-center">
							<section class="d-flex flex-row align-items-center">
								<section class="rounded-circle p-2">
									<img src="<?= $dataUser['img_user'] ?>" class="img-profileComm img-rounded"/>
								</section>
								<h4 class="fs-6"><?= $dataUser['nom_user'].' '.$dataUser['prenom_user'] ?></h4>
							</section>
							<p><?= publieDepuis($dataComm[$i]['date_com']) ?></p>
							<!-- utiliser diffDate avec des split pour separer date et heure -->
						</section>
						<section class="mx-3 mb-5">
							<?= $dataComm[$i]['contenu_com'] ?>
						</section>
					</section>
					<?php
				}
					?>
				</section>
				<?php require_once "include/footer.php"; ?>
			</section>
	</body>
</html>