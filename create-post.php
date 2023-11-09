<?php
include "include/is-connected.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Création d'un poste</title>
    <?php require_once "include/head.php"; ?>
</head>

<body>
    <?php
    require_once "include/bdd.php";
    require_once "include/nav.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assurez-vous de valider et nettoyer les données avant de les utiliser dans vos requêtes SQL
        $titre_imp = isset($_POST["textAreaTitreImp"]) ? htmlspecialchars($_POST["textAreaTitreImp"]) : "";
        $contenu_imp = isset($_POST["textAreaContenuImp"]) ? htmlspecialchars($_POST["textAreaContenuImp"]) : "";
        $datePubli = date("y-m-d H:i:s");
        // Vérifiez si les données nécessaires sont présentes
        if (!empty($titre_imp) && !empty($contenu_imp)) {
            try {
                $id_theme = isset($_POST["id_theme"]) ? $_POST["id_theme"] : null;

                // Assurez-vous de valider et nettoyer les données avant de les utiliser dans vos requêtes SQL
                $req = $bdd->prepare("INSERT INTO impression (titre_imp, contenu_imp, id_theme, id_user, date_imp) VALUES (:titre, :contenu, :theme, :id_user, :datePubli)");
                $req->bindParam(':titre', $titre_imp, PDO::PARAM_STR);
                $req->bindParam(':contenu', $contenu_imp, PDO::PARAM_STR);
                $req->bindParam(':theme', $id_theme, PDO::PARAM_INT);
                $req->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                $req->bindParam(':datePubli', $datePubli, PDO::PARAM_STR);
                $req->execute();

                echo "Impression ajoutée avec succès.";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs obligatoires.";
        }
    }
    ?>

    <form id="formulaire" method="POST">
        <!-- ... Votre formulaire ici ... -->
        <section class="rounded-textarea d-flex justify-content-between mb-3">
            <textarea id="textAreaTitreImp" name="textAreaTitreImp" rows="1" placeholder="Titre de l'impression..."></textarea>
        </section>

        <section class="d-flex justify-content-between mb-3">
        <select id="select_theme" class="form-select" name="id_theme" aria-label="Sélectionnez votre thème">
            <option value="">Sélectionnez un thème</option>
                <?php
                    // Récupérez les thèmes de la base de données
                    $req = $bdd->query("SELECT id_theme, libelle_theme FROM theme");
                        while ($theme = $req->fetch()) {
                            echo "<option value='{$theme['id_theme']}'>{$theme['libelle_theme']}</option>";
    }
    ?>
</select>
        </section>

        <section class="rounded-textarea d-flex justify-content-between mb-3">
            <textarea id="textAreaContenuImp" name="textAreaContenuImp" rows="10" placeholder="Contenu de l'impression..."></textarea>
        </section>

        <section class="d-flex align-items-center justify-content-center w-5 h-5 mb-2">
            <button type="submit" class="btn btn-primary mx-2 my-3 justify-content-center">
                <svg class="align-items-center" fill="white" height="25" viewBox="0 0 8 8" width="25" xmlns="http://www.w3.org/2000/svg">
                    <path d="m6.41 0-.69.72-2.78 2.78-.81-.78-.72-.72-1.41 1.41.72.72 1.5 1.5.69.72.72-.72 3.5-3.5.72-.72z" transform="translate(0 1)" />
                </svg>
                Valider
            </button>
        </section>
    </form>
</body>

</html>
