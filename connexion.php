<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
        <?php include "include/head.php"; ?>
	</head>	
	<body class="bg-grey-light w-100">
<?php
    include "include/bdd.php";
    include "include/nav.php";

    if(isset($_POST['mail']) && isset($_POST['password'])){
        $mail = $_POST['mail'];
        $mdp = hash('sha256', $_POST['password']);
        $req_co = "SELECT mail_user, mdp_user FROM user WHERE mail_user = '$mail' AND mdp_user = '$mdp'";
        $co = $bdd->prepare($req_co);
        $co->execute();
        $user_exist = $co->rowCount();

        if($user_exist == 1){
        //* Verifiaction du role du compte (si banni)
            $req = $bdd->prepare("SELECT id_user, role_user FROM user WHERE mail_user = '$mail'");
            $req->execute();
            $data = $req->fetch(\PDO::FETCH_OBJ);
            $id_user = $data->id_user;
            $role_user = $data->role_user;

            if($role_user == 2){
                $mess = 'Votre comte à été banni.';
            } else {
                //* Si le compte est valid
                session_start();
                $_SESSION['id_user'] = intval($id_user);
                $_SESSION['role_user'] = intval($role_user);
                header("location:index.php");
            }
        }
    }

?>
        <!-- <div class="row justify-content-center mt-4 w-100"> -->
            <!-- <div class="col-10 col-md-8 col-lg-6 col-xl-4 text-center card rounded-5 p-2 p-md-3 p-lg-4"> -->
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
            <!-- </div> -->
        <!-- </div> -->


        <?php include "include/footer.php"; ?>
	</body>
</html>