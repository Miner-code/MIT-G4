<!DOCTYPE HTML>
<html>
	<head>
		<title>Inscription</title>
        <?php include "includes/head.php"; ?>
        <script src="assets/js/inscription.js"></script>
	</head>	
	<body>
    <?php
    include "includes/bdd.php";
    include "includes/nav.php";
    include "includes/gestion-inscription.php"
    ?>

        <div class="row justify-content-center my-4" style="width:100%;">
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
                        <label for="mail" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" name="mail" pattern="[a-z0-9._%+-éèàùç]+@[a-z0-9.-]+\.[a-z]{2,3}" value="<?php if(isset($_POST['mail'])){ echo $mail; } ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="dtn" class="form-label">Date de naissance (pas obligatoire)</label>
                        <input type="date" class="form-control datepicker_input" name="dtn" value="<?php if(isset($_POST['dtn'])){ echo $dtn; } ?>">
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
                    <div class="mb-2">
                        <label for="cursus" class="form-label">Cursus</label>
                        <select id="cursus" class="form-select" name='num_cursus' aria-label="Selectionné votre cursus">
                            <?php 
                            $req = $bdd->query("SELECT * FROM cursus");
                            $dataCursus = $req->fetchAll();
                            foreach ($dataCursus as $li){
                                print('<option value="'.$li['num_cursus'].'">'.$li['libele_cursus'].' '.$li['spe_cursus'].'</option>');
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2 d-flex justify-content-center">
                        <div class="form-check pe-2">
                            <input class="form-check-input" type="radio" name="cursus_radio" id="cursus_en_cour" value="cursus_en_cour" onchange="onChangeEndCursus()" checked>
                            <label class="form-check-label" for="cursus_en_cour">
                                Etude en cours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cursus_radio" id="cursus_fini" value="cursus_fini" onchange="onChangeEndCursus()">
                            <label class="form-check-label" for="cursus_fini">
                                Etude terminé
                            </label>
                        </div>
                    </div>
                    <div id="onCursusEnd"></div>
                    <div class="mb-2">
                        <label for="select_etab" class="form-label">Etablissement</label>
                        <select id="select_etab" class="form-select" name="num_etab" aria-label="Selectionné votre établissement" onchange="onOtherEtab()">
                            <option value="">sélectionné votre établissement</option>
                            <?php 
                            $req = $bdd->query("SELECT * FROM etablissement");
                            $dataEtab = $req->fetchAll();
                            foreach ($dataEtab as $li){
                                print('<option value="'.$li['num_etab'].'">'.$li['nom_etab'].'</option>');
                            }
                            ?>
                            <option value="null">autre</option>
                        </select>
                    </div>
                    <div id="onOtherEtab"></div>
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