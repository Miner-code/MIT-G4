<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
        <?php include "includes/head.php"; ?>
	</head>	
	<body>
<?php
    include "includes/bdd.php";
    include "includes/nav.php";

    if(isset($_POST['mail']) && isset($_POST['password'])){
    
        $mail = $_POST['mail'];
        $mdp = sha1($_POST['password']);
        
        $req_co = "SELECT mail, mdp FROM user WHERE mail = '$mail' AND mdp = '$mdp'";
        $co = $bdd->prepare($req_co);
        $co->execute();
        $user_exist = $co->rowCount();
        
        if($user_exist == 1){
            //* Verifiaction de l'etat du comte : attValid / valid / banni
            $req = $bdd->prepare("SELECT etat FROM user WHERE mail = '$mail'");
            $req->execute();
            $result = $req->fetch(\PDO::FETCH_OBJ);
            $etat =  $result->etat;

            if($etat == 'attValid'){
                $mess = 'Votre comte est en cour de validation.';
            }
            if($etat == 'banni'){
                $mess = 'Votre comte à été banni.';
            }
        //* Si le compte est valid
            if($etat == 'valid'){
                $req = $bdd->prepare("SELECT grade, pseudo, id FROM user WHERE mail = '$mail'");
                $req->execute();
                $result = $req->fetch(\PDO::FETCH_OBJ);
                $grade =  $result->grade;
                $pseudo =  $result->pseudo;
                $id =  $result->id;
    
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['grade'] = $grade;
                $_SESSION['mail'] = $mail;
                $_SESSION['pseudo'] = $pseudo;
                header("location:index.php");
            }
        }
    }

?>
        <div class="row justify-content-center mt-4" style="width:100%;">
            <div class="col-4 text-center">
                <form method="post">
                    <h1>Connexion</h1>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" name="mail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
                <hr/>
                <?php if(isset($mess)){echo $mess.'<hr/>';} ?>
                <a href="inscription.php">Vous n'avez pas de compte, inscrivez-vous !</a>
            </div>
        </div>


        <?php include "includes/footer.php"; ?>
	</body>
</html>