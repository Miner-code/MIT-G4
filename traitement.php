<?php
    session_start();
    include "include/bdd.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["message"])) {
            $message = $_POST["message"];

            // On remplace "l'id_entreprise" par le champ approprié de votre table
            // qui stocke l'ID de l'entreprise.
            $id_entreprise = 1;

            // Insérez le message dans la table des impression
            $sql = "INSERT INTO impression (titre, contenu, num_date, num_1, num_user)
                    VALUES (:titre, :contenu, NOW(), :num_1, :num_user)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(":titre", $_SESSION["nom_entreprise"]);
            $stmt->bindParam(":contenu", $message);
            $stmt->bindParam(":num_1", $id_entreprise);
            $stmt->bindParam("num_user", $_SESSION["id_utilisateur"]); // Remplacez par l'ID de l'utilisateur connecté

            if($stmt->execute()) {
                // On redirige l'utilisateur vers la page d'acceuil ou une autre page de confirmation
                header("Location: index.php");
                exit();
            } else {
                echo "Une erreur s'est produite lors de la publication";
            }
        }
    }
?>