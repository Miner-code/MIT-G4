<?php
session_start();
include "include/bdd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["message"])) {
        $message = $_POST["message"];

        $id_etab = 1; 

        
        $sql = "INSERT INTO impression (titre_imp, contenu_imp, date_imp, id_theme, id_user)
                VALUES (:titre, :contenu, NOW(), :id_etab, :id_user)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(":titre", $_SESSION["nom_etab"]); 
        $stmt->bindParam(":contenu", $message);
        $stmt->bindParam(":id_etab", $id_etab);
        $stmt->bindParam(":id_user", $_SESSION["id_user"]); 

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "An error occurred while posting.";
        }
    }
}
?>
