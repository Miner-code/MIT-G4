<?php
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si le formulaire de recherche a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les critères de recherche depuis le formulaire
    $id_user = $_POST['id_user'];
    $id_impression = $_POST['id_impression'];

    // Construire la requête SQL en fonction des critères de recherche fournis
    $sql = "SELECT * FROM messages WHERE 1=1"; // Utilisation de "1=1" pour construire une requête conditionnelle

    if (!empty($id_user)) {
        $sql .= " AND id_user LIKE :id_user";
    }

    if (!empty($id_impression)) {
        $sql .= " AND id_impression LIKE :id_impression";
    }

    // Préparer la requête SQL avec PDO
    $stmt = $pdo->prepare($sql);

    if (!empty($id_user)) {
        $id_userParam = "%" . $id_user . "%";
        $stmt->bindParam(':id_user', $id_userParam, PDO::PARAM_STR);
    }

    if (!empty($id_impression)) {
        $id_impressionParam = "%" . $id_impression . "%";
        $stmt->bindParam(':id_impression', $id_impressionParam, PDO::PARAM_STR);
    }

    // Exécuter la requête SQL
    if ($stmt->execute()) {
        // Afficher les résultats de la recherche
        echo "<h1>Résultats de la recherche :</h1>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Utilisateur : " . $row['id_user'] . "<br>";
            echo "Nom du poste : " . $row['id_impression'] . "<br>";
            echo "Message : " . $row['message'] . "<br><br>";
        }
    } else {
        echo "Erreur de requête : " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recherche de messages</title>
</head>
<body>
    <h1>Recherche de messages</h1>
    <form method="POST" action="search.php">
        <label for="id_user">Nom d'utilisateur:</label>
        <input type="text" name="id_user"><br>

        <label for="id_impression">Nom du poste:</label>
        <input type="text" name="id_impression"><br>

        <input type="submit" value="Rechercher">
    </form>
</body>
</html>
