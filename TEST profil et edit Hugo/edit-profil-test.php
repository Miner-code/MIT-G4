<?php
// Inclure le fichier de configuration de la base de données
include 'config.php'; 

session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom_user = $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $mail_user = $_POST['mail_user'];
    $dtn_user = $_POST['dtn_user'];

    // Récupérer l'ID de l'utilisateur connecté
    $id_user = $_SESSION['id_user'];

    // Mettre à jour les informations du profil dans la base de données
    $query = "UPDATE user SET nom_user='$nom_user', prenom_user='$prenom_user', mail_user='$mail_user', dtn_user='$dtn_user' WHERE id_user = $id_user";

    if (mysqli_query($conn, $query)) {
        echo "Profil mis à jour avec succès!";
    } else {
        echo "Erreur lors de la mise à jour du profil : " . mysqli_error($conn);
    }
}

// Récupérer les informations actuelles de l'utilisateur à partir de la base de données
$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM user WHERE id_user = $id_user";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Erreur de requête : " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Éditer le profil</title>
</head>
<body>
    <h1>Éditer le profil</h1>
    <form method="POST" action="edit-profil.php">
        <label for="nom_user">Nom:</label>
        <input type="text" name="nom_user" value="<?php echo $user['nom_user']; ?>"><br>

        <label for="prenom_user">Prénom:</label>
        <input type="text" name="prenom_user" value="<?php echo $user['prenom_user']; ?>"><br>

        <label for="mail_user">Email:</label>
        <input type="email" name="mail_user" value="<?php echo $user['mail_user']; ?>"><br>

        <label for="dtn_user">Date de naissance:</label>
        <input type="date" name="dtn_user" value="<?php echo $user['dtn_user']; ?>"><br>

        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
