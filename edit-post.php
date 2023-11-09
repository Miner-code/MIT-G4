<?php
include "include/is-connected.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Édition d'un poste</title>
    <?php require_once "include/head.php"; ?>
</head>

<body>
    <?php
    require_once "include/bdd.php";
    
    // Récupération des données du poste existant
    $id_impression = $_GET['id_impression'];

    $req = $bdd->prepare("SELECT * FROM impression WHERE id_imp = :id_impression");
    $req->bindParam(':id_impression', $id_impression, PDO::PARAM_INT);
    $req->execute();
    $post_data = $req->fetch(PDO::FETCH_ASSOC);

    if ($post_data['id_user'] != $_SESSION['id_user']) {
        header("location:index.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["textAreaTitreImp"])) {
            $titre_imp = htmlspecialchars($_POST["textAreaTitreImp"]);
        }
        if (isset($_POST["textAreaContenuImp"])) {
            $contenu_imp = htmlspecialchars($_POST["textAreaContenuImp"]);
        }
        if (isset($_POST["id_theme"])) {
            $id_theme = htmlspecialchars($_POST["id_theme"]);
        }
        $datePubli = date("y-m-d H:i:s");

        if (!empty($titre_imp) && !empty($contenu_imp) && !empty($id_theme)) {
            try {
                if (isset($_GET['id_impression'])) {
                    // Édition d'un poste existant
                    $id_impression = $_GET['id_impression'];
                    $req = $bdd->prepare("UPDATE impression SET titre_imp = :titre, contenu_imp = :contenu, id_theme = :theme, date_imp = :datePubli WHERE id_imp = :id_impression");
                    $req->bindParam(':titre', $titre_imp, PDO::PARAM_STR);
                    $req->bindParam(':contenu', $contenu_imp, PDO::PARAM_STR);
                    $req->bindParam(':theme', $id_theme, PDO::PARAM_INT);
                    $req->bindParam(':datePubli', $datePubli, PDO::PARAM_STR);
                    $req->bindParam(':id_impression', $id_impression, PDO::PARAM_INT);
                    $req->execute();

                    // Redirection vers view-post.php
                    $whereGo = "view-post.php?id_impression=".$id_impression;
                    header("location:".$whereGo);
                    exit();
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Veuillez remplir tous les champs obligatoires.";
        }
    }
    require_once "include/nav.php";
    ?>

    <form id="formulaire" method="POST" class="mx-adapt">
        <section class="rounded-textarea d-flex justify-content-between mb-3">
            <textarea id="textAreaTitreImp" name="textAreaTitreImp" rows="1" placeholder="Titre de l'impression..." required><?=$post_data['titre_imp']?></textarea>
        </section>

        <section class="d-flex justify-content-between mb-3">
            <select id="select_theme" class="form-select" name="id_theme" aria-label="Sélectionnez votre thème">
                <option value="">Sélectionnez un thème</option>
                <?php
                // Récupération des thèmes de la base de données
                $req = $bdd->query("SELECT id_theme, libelle_theme FROM theme");
                while ($theme = $req->fetch()) {
                    $selected = ($post_data['id_theme'] == $theme['id_theme']) ? 'selected' : '';
                    echo "<option value='{$theme['id_theme']}' $selected>{$theme['libelle_theme']}</option>";
                }
                ?>
            </select>
        </section>

        <section class="rounded-textarea d-flex justify-content-between mb-3">
            <textarea id="textAreaContenuImp" name="textAreaContenuImp" rows="10" placeholder="Contenu de l'impression..." required><?=$post_data['contenu_imp']?></textarea>
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
