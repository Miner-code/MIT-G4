<?php
session_start();
if(empty($_SESSION['grade'])){
    header('location:index.php');
    exit();
}
if($_GET['id'] != $_SESSION['id']){
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Profil</title>
	<?php include "includes/head.php"; ?>
</head>
	<body>
		<?php 
		include "include/bdd.php";
		include "include/nav.php";
		include "include/panier.php"; 

        $id = $_GET['id'];
        include "includes/gestion-edit-profil.php";
//! historique achat/vente

    

    //* nombre d'image mis en vente par le id_vendeur
    $req = $bdd->prepare("SELECT * FROM image WHERE id_vendeur = '$id'");
    $req->execute();
    $nb_image = $req->rowCount();

    //* Recuperation des info de l'utilisateur en fonction du $_GET
    $req = $bdd->query("SELECT * FROM user WHERE id = '$id'");
    $data = $req->fetchAll();
    foreach ($data as $li){
        
?>

<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="card">
    <?php
//////////* Start Profil edit //////////
    ?>
      <form method="post" enctype="multipart/form-data">
        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column text-black">
                <!-- Image de l'utilisateur -->
                <div style="z-index:1;">
                  <div id="output" class="img-fluid img-thumbnail mt-4 mb-2" style="background-size: cover; width: 150px; height: 150px; background-image:url(<?php echo $li['img_profil']; ?>)"></div>
                </div>
            </div>
            <div class="ms-3" style="margin-top: 160px;">
                <!-- Pseudo de l'utilisateur -->
                <h5><?php echo $li['pseudo']; ?></h5>
            </div>
        </div>
        <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="row">
                <div class="col-7 col-md-6 col-lg-4">
                    <label for="img_profil" class="input-group-text">Image du profil :</label>
                    <input type="file" class="form-control" name="img_profil" id="img_profil" onchange="loadFile(event)">
                </div>
                <div class="col">
                    <div class="d-flex justify-content-end text-center py-1">
                        <div>
                            <!-- Compteur de photo -->
                            <p class="mb-1 h5"><?php echo $nb_image; ?></p>
                            <p class="small text-muted mb-0">Photos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-4 text-black">
          <div class="mb-5">
            <p class="lead fw-normal mb-1">Mes information</p>
            <?php
                if(isset($mes_error)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo $mes_error;
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                }
            ?>
            <div class="p-4" style="background-color: #f8f9fa;">
              <!-- Tableau des information de l'utilisateur -->
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Nom :</th>
                    <td><input type="text" class="form-control" name="nom" pattern="[a-zA-Zéè]{3,15}" value="<?php echo $li['nom']; ?>" required></td>
                  </tr>
                  <tr>
                    <th scope="row">Prenom :</th>
                    <td><input type="text" class="form-control" name="prenom" pattern="[a-zA-Zéè]{3,15}" value="<?php echo $li['prenom']; ?>" required></td>
                  </tr>
                  <tr>
                    <th scope="row">Pseudo :</th>
                    <td><input type="text" class="form-control" name="pseudo" pattern="[a-zA-Zéè]{3,15}" value="<?php echo $li['pseudo']; ?>" required></td>
                  </tr>
                  <tr>
                    <th scope="row">Mail :</th>
                    <td><input type="text" class="form-control" name="mail" pattern="[a-z0-9._%+-éèàùç]+@[a-z0-9.-]+\.[a-z]{2,3}" value="<?php echo $li['mail']; ?>" required></td>
                  </tr>
                  <tr>
                    <th scope="row">N°siret : <br/>(Si vous changer votre numero de siret, <br/>votre compte sera mis en attende de validation)</th>
                    <td><input type="text" class="form-control" name="siret" pattern="[0-9]{14}" value="<?php echo $li['SIRET']; ?>" required></td>
                  </tr>
                  <tr>
                    <th scope="row">Credits :</th>
                    <td><?php echo $li['credits']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Ancient mot de passe :</th>
                    <td><input type="password" class="form-control" name="old-password" required></td>
                  </tr>
                  <tr>
                    <th scope="row">Nouveau mot de passe :</th>
                    <td><input type="password" class="form-control" name="new-password1"></td>
                  </tr>
                  <tr>
                    <th scope="row">Nouveau mot de passe :</th>
                    <td><input type="password" class="form-control" name="new-password2"></td>
                  </tr>
                </tbody>
              </table>
              <button type="submit" name="edit-valid" class="btn btn-success">Valider les changement</button>
              <!-- btn pour revenir a la page profil -->
              <a href="profil.php?id=<?php echo $li['id']; ?>" class="btn btn-danger">Annuler les changement</a>
            </div>
          </div>
        </div>
      </form>
      <div class="card-body p-4 text-black">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <p class="lead fw-normal mb-0">Recent photos</p>
        </div>
        <div class="row g-2">
        <?php
        //* Liste des images de l'utilisateur qui sont encore achetable
          $req_img = $bdd->query("SELECT * FROM Image WHERE id_vendeur = '$id' AND id_acheteur IS NULL");
          $req_img->execute();
          $data_img = $req_img->fetchAll();
          echo '<section class="py-5">';
          echo '<div class="container px-4 px-lg-5 mt-5">';
          echo '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';

          foreach ($data_img as $li_img){
                    echo '<div class="col mb-5">';
            echo '	<a style="text-decoration:none; color:black;" href="categorie.php?categorie='.$li_img['nom_categorie'].'&img='.$li_img['id_image'].'">';
                    echo '		<div class="card h-100">';
            //* image rogné width: auto; height: 15em;
            echo '			<div style="background-size: cover; width: auto; height: 15em; background-image:url('.$li_img['chemin_image'].')"></div>';
                    echo '			<div class="card-body p-4">';
                    echo '				<div class="text-center">';
                    echo '					<h5 class="fw-bolder">'.$li_img['nom_image'].'</h5>';
                    echo 					$li_img['prix_image'].' crédits <hr/>';
                    echo 					$li_img['nom_categorie'];
                    echo '				</div>';
                    echo '			</div>';
                    echo '		</div>';
            echo '	</a>';
            echo '</div>';
          }
          echo '</div>';
          echo '</div>';
          echo '</section>';



          ?>



        </div>
      </div>
      <script>
        //* script pour l'affichage automatique de l'image
            var loadFile = function(event){
                var output = document.getElementById('output');
                output.style.backgroundImage = "url(" + URL.createObjectURL(event.target.files[0]) + ")";
                output.onload = function(){
                    URL.revokeObjectURL(output.style.backgroundImage);
                }
            }
      </script>
    <?php
//////////* End Profil edit //////////
    ?>


            </div>
        </div>
    </div>
</section>

<?php
  }
?>


		<?php include "includes/footer.php"; ?>
	</body>
</html>