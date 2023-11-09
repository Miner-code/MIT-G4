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

        $req = $bdd->prepare("SELECT * FROM user WHERE id_user = ".$_SESSION['id_user']);
		$req->execute();
		$dataUser = $req->fetch(PDO::FETCH_ASSOC);
		// var_dump($dataUser);                        
    ?>
    <form id="formulaire" method="POST">
        <?php
            $titre_imp = isset($_POST["textAreaTitreImp"]) ? htmlspecialchars($_POST["textAreaTitreImp"]) : "";
            $contenu_imp = isset($_POST["textAreaContenuImp"]) ? htmlspecialchars($_POST["textAreaContenuImp"]) : "";
        ?>
        <section class="rounded-textarea d-flex justify-content-between mb-3">
            <textarea id="textAreaTitreImp" name="textAreaContenuImp" rows="1" placeholder="Titre de l'impression..."></textarea>
        </section>

        <section class="d-flex justify-content-between mb-3">
            <select id="select_theme" class="form-select" name="id_theme" aria-label="Selectionné votre theme">
                <option value="">sélectionné votre thème</option>
                <?php 
                    $req = $bdd->query("SELECT * FROM theme");
                    $dataTheme = $req->fetchAll();
                    foreach ($dataTheme as $li){
                        print('<option value="">'.$li["libelle_theme"].'</option>');
                    }
                ?>
                <option value="null">autre</option>
            </select>
        </section>

        <section class="rounded-textarea d-flex justify-content-between mb-3">
            <textarea id="textAreaContenuImp" name="textAreaContenuImp" rows="10" placeholder="Contenu de l'impression..."></textarea>
        </section>
	</form>

    
    <section class="d-flex align-items-center justify-content-center w-5 h-5 mb-2">
		<button type="submit" class="btn btn-primary mx-2 my-3 justify-content-center">
			<svg class="align-items-center" fill="white" height="25" viewBox="0 0 8 8" width="25" xmlns="http://www.w3.org/2000/svg">
                <path d="m6.41 0-.69.72-2.78 2.78-.81-.78-.72-.72-1.41 1.41.72.72 1.5 1.5.69.72.72-.72 3.5-3.5.72-.72z" transform="translate(0 1)"/>
			</svg>
            Valider
		</button>        
	</section>
</body>