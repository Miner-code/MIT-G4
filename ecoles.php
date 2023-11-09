<?php
include "include/is-connected.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Unea.com</title>
	<?php include "include/head.php"; ?>
    <script src="assets/js/ecoles.js"></script>
</head>
	<body>
		<?php 
		include "include/bdd.php";
		include "include/nav.php";
		include "function/difDate.php";
		?>
        <section class="d-flex flex-column align-items-center mt-2 mb-4 mx-card-home">
            <select id="select_etab" class="form-select w-50" name="id_etab" aria-label="Selectionnez une école" onchange="onChangeSchool()">
                <option value="">Selectionnez un établissement</option>
                <?php 
                $req = $bdd->query("SELECT * FROM etablissement");
                $dataEtab = $req->fetchAll();
                foreach ($dataEtab as $li) {
                    print('<option value="'.$li['id_etab'].'">'.$li['nom_etab'].'</option>');
                }
                ?>
            </select>
            <img class="d-none my-3" id="img-etab" src="" alt="image de l'etablissement">
        </section>
        <hr class="mx-card-home">

        <section class="d-flex flex-column align-items-center mx-card-home" id="impression-by-theme"></section>
		
		<?php include "include/footer.php"; ?>
	</body>
</html>