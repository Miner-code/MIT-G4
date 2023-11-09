<?php
include "include/is-connected.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Unea.com</title>
	<?php include "include/head.php"; ?>
    <script src="assets/js/themes.js"></script>
</head>
	<body>
		<?php 
		include "include/bdd.php";
		include "include/nav.php";
		include "function/difDate.php";
		?>
        <section class="d-flex justify-content-center mt-2 mb-4 mx-card-home">
            <select id="select_theme" class="form-select w-50" name="id_etab" aria-label="Selectionnez un theme" onchange="onChangeThemes()">
                <option value="">Selectionnez un theme</option>
                <?php 
                $req = $bdd->query("SELECT * FROM theme");
                $dataTheme = $req->fetchAll();
                foreach ($dataTheme as $li){
                    print('<option value="'.$li['id_theme'].'">'.$li['libelle_theme'].'</option>');
                }
                ?>
            </select>
        </section>
        <hr class="mx-card-home">

    <section class="d-flex flex-column align-items-center mx-card-home" id="impression-by-theme"></section>

		
		<?php include "include/footer.php"; ?>
	</body>
</html>