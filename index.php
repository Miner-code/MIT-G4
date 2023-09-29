<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Unea.com</title>
	<?php include "includes/head.php"; ?>
</head>
	<body>
		<?php 
		include "includes/bdd.php";
		include "includes/nav.php";
		?>
		<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $identifiant = $_POST["Identifiant"];
    $civilite = $_POST["Civilité"];
    $email = $_POST["Email"];
    $motDePasse = $_POST["MotDePasse"];
    $verificationMotDePasse = $_POST["VerificationMotDePasse"];
    $telephone = $_POST["Telephone"];
    $pays = $_POST["Pays"];
    $conditionsGenerales = isset($_POST["ConditionsGenerales"]) ? "Accepté" : "Non accepté";

    // Envoi d'un e-mail avec les données
    $to = "votre@email.com";
    $subject = "Nouvelle soumission de formulaire";
    $message = "Identifiant: $identifiant\n";
    $message .= "Civilité: $civilite\n";
    $message .= "Email: $email\n";
    $message .= "Mot de passe: $motDePasse\n";
    $message .= "Téléphone: $telephone\n";
    $message .= "Pays: $pays\n";
    $message .= "Conditions générales acceptées: $conditionsGenerales\n";

    mail($to, $subject, $message);

    // Redirection vers une page de confirmation
    header("Location: confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire PHP</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="text/plain">
        <div class="Informations">
            <!-- ... Votre formulaire HTML existant ... -->
        </div>
        <div class="Envoyer-Information">
            <button type="submit" class="submit-Button">Soumettre</button>
        </div>
    </form>
</body>
</html>

		
		<?php include "includes/footer.php"; ?>
	</body>
</html>