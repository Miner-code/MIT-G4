<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Pour une modification dans la base de données : Programme -> BDD SQL
try {
    // Connexion à la base de données :
    $bdd = new PDO('mysql:host=localhost;dbname=UNEA', 'root', '');

    // Requête SQL :
    $stmt = $bdd->prepare("");// Requête SQL entre les ""

    // Exécutez la requête
    $stmt->execute();

    echo "Données insérées avec succès."; // Message de confirmation 

// Si erreur :
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Pour une récupération de données : BDD SQL -> Programme
try {
    // Connexion à la base de données :
    $bdd = new PDO('mysql:host=localhost;dbname=UNEA', 'root', '');

    // Requête SQL :
    $stmt = $bdd->prepare("");// Requête SQL entre les ""

    // Exécutez la requête
    $stmt->execute();

    // Récupérez les résultats
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Parcourez les résultats
    foreach ($resultats as $row) { // pour tous les résultats récupérer
        echo $resultats // On affiche le résultat
    }
// Si erreur :
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>