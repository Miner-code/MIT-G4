<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si l'ID de l'utilisateur est passé en paramètre GET
if (isset($_GET['id_user'])) {
    // Récupérer l'ID de l'utilisateur à partir des paramètres GET
    $id_user = $_GET['id_user'];
    
    // Sélectionner les informations de l'utilisateur depuis la base de données
    $query = "SELECT * FROM user WHERE id_user = $id_user";
    $result = mysqli_query($conn, $query);
    
    // Vérifier si la requête a réussi
    if ($result) {
        // Récupérer les données de l'utilisateur
        $user = mysqli_fetch_assoc($result);
        
        // Afficher les informations du profil de l'utilisateur
        echo "<h1>Profil de {$user['nom_user']} {$user['prenom_user']}</h1>";
        echo "<p><strong>Nom:</strong> {$user['nom_user']}</p>";
        echo "<p><strong>Prénom:</strong> {$user['prenom_user']}</p>";
        echo "<p><strong>Email:</strong> {$user['mail_user']}</p>";
        echo "<p><strong>Date de naissance:</strong> {$user['dtn_user']}</p>";
        echo "<p><strong>Role:</strong> {$user['role_user']}</p>";
        
        // Fermer la connexion à la base de données
        mysqli_close($conn);
    } else {
        echo "Erreur de requête : " . mysqli_error($conn);
    }
} else {
    echo "ID d'utilisateur non spécifié.";
}
?>
