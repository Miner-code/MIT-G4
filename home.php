<?php
include "include/is-connected.php";
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
		include "function/difDate.php";
		?>
    <?php

    $req = $bdd->prepare("SELECT * FROM impression ORDER BY date_imp DESC");
    $req->execute();
    $dataImpressions = $req->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section class="d-flex justify-content-end">
        <a href="" class="btn btn-primary mb-3 px-4">
            <svg height="24" viewBox="0 0 8 8" width="24" fill="white" class="me-2" xmlns="http://www.w3.org/2000/svg"><path d="m3 0v3h-3v2h3v3h2v-3h3v-2h-3v-3z"/></svg>
            Nouveau
        </a>
    </section>

    <section class="d-flex flex-column align-items-center mx-card-home">
<?php
    foreach ($dataImpressions as $dataImpression) {

        $req = $bdd->prepare("SELECT nom_user, prenom_user, img_user FROM user WHERE id_user = ".$dataImpression['id_user']);
        $req->execute();
        $dataUser = $req->fetch(PDO::FETCH_ASSOC);
?>
        <a class="card rounded-5 mb-5 w-100 p-4 text-decoration-none grey-dark w-100" href="view-post.php?id_impression=<?=$dataImpression['id_imp']?>">
            <section class="d-flex flex-row justify-content-between align-items-center">
                <object>
                    <a href="profil.php?id=<?=$dataImpression['id_user']?>">
                        <img src="<?=$dataUser['img_user']?>" alt="image de profil" class="rounded-circle" style="width:5em; height:5em;">
                    </a>
                </object>
                <h3 class="border-bottom border-dark"><?=$dataImpression['titre_imp']?></h3>
                <span style="width:5em; height:5em;"></span>
            </section>
            <section class="mx-content-imp"><?=$dataImpression['contenu_imp']?></section>
            <section class="d-flex justify-content-end">
                <?=$dataUser['nom_user']." ".$dataUser['prenom_user']." - ".publieDepuis($dataImpression['date_imp'])?>
            </section>
        </a>
<?php
    }
?>
    </section>

		
		<?php include "include/footer.php"; ?>
	</body>
</html>