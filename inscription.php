<!DOCTYPE HTML>
<html>
	<head>
		<title>Inscription</title>
        <?php include "includes/head.php"; ?>
	</head>	
	<body>
    <?php
    include "includes/bdd.php";
    include "includes/nav.php";
    include "includes/gestion-inscription.php"

    ?>

        <div class="row justify-content-center mt-4" style="width:100%;">
            <div class="col-4 text-center">
                <form method="post" enctype="multipart/form-data">
                    <h1>Inscription</h1>
                    <div class="mb-2">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" pattern="[a-zA-Zéè]{3,15}" value="<?php if(isset($_POST['nom'])){ echo $nom; } ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" name="prenom" pattern="[a-zA-Zéè]{3,15}" value="<?php if(isset($_POST['prenom'])){ echo $prenom; } ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" pattern="[a-zA-Zéè]{3,15}" value="<?php if(isset($_POST['pseudo'])){ echo $pseudo; } ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="mail" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" name="mail" pattern="[a-z0-9._%+-éèàùç]+@[a-z0-9.-]+\.[a-z]{2,3}" value="<?php if(isset($_POST['mail'])){ echo $mail; } ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="img_profil" class="form-label">Image (pas obligatoire)</label><br/>
                        <input class="align-center" type="file" name="img_profil" onchange="loadFile(event)">
                        <!-- Previsualisation de l'image qui vient d'arriver -->
                        <img style="height:auto; width:10em" id="output" />
                    </div>
                    <div class="mb-2">
                        <label for="password1" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password1" required>
                    </div>
                    <div class="mb-2">
                        <label for="password2" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password2" required>
                    </div>
                    <p><input type="radio" value="photographe" name="grade" id="photographe" onclick="actualisation_grade()" <?php if(isset($_POST['grade'])){if($_POST['grade']=='photographe'){echo 'checked';}}else{echo 'checked';} ?>> photographe
                    <input type="radio" value="client" name="grade" id="client" onclick="actualisation_grade()" <?php if(isset($_POST['grade'])){if($_POST['grade']=='client'){echo 'checked';}} ?>> client</p><br/>

                    <div class="mb-2" id="suite_form">
                        <label for="siret" class="form-label">Num SIRET</label>
                        <input class="form-control" name="siret" pattern="[0-9]{14}" required>

                        <script type="text/javascript">
                            //* fonction pour modifié le formulaire en fonction de l'option coché (photographe ou client)
                            function actualisation_grade(){
                                var photographe = document.getElementById('photographe');
                                var client = document.getElementById('client');
                                var suite_form = document.getElementById('suite_form');
                                //* si photographe est coché, il faut en plus renseigné  le numéro de SIRET
                                if(photographe.checked == true){
                                    suite_form.innerHTML = '<label for="siret" class="form-label">Num SIRET</label><input class="form-control" name="siret" pattern="[0-9]{14}" required>';
                                }
                                if(client.checked == true){
                                    suite_form.innerHTML = '';
                                }
                            }
                            //* si le grade est client et que l'inscription n'a pas fonctionné -> re-declenchement de la fonction pour avoir le bon affichage
                            <?php if(isset($_POST['grade'])){if($_POST['grade']=='client'){echo 'actualisation_grade()';}} ?>
                        </script>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
                </form>
                <?php
                echo $mes_error;
                ?>
                <hr/>
                <a href="connexion.php">Vous avez déjà un compte, connectez-vous !</a>
            </div>
        </div>


        <?php include "includes/footer.php"; ?>
        <script>
        //* script pour l'affichage automatique de l'image
            var loadFile = function(event){
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function(){
                    URL.revokeObjectURL(output.src);
                }
            }
        </script>

	</body>
</html>