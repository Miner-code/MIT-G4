<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      UNEA
      <!-- <img src="assets/img/logoFondTransparent.png" alt="logo UNEA" class="navbar-logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <?php
      if(isset($_SESSION['grade'])){
          echo '<li class="nav-item"><a class="nav-link" href="profil.php?id='.$_SESSION['id'].'">Mon compte</a></li>';
      }
          ?>
        <?php
        if(isset($_SESSION['grade'])){
            if($_SESSION['grade'] == 'admin'){
                echo '<li class="nav-item"><a class="nav-link" href="gestion-utilisateur.php">Gestion utilisateur</a></li>';
            }
        }
          ?>
        <!-- <li class="nav-item"><a class="nav-link" href="nous-contacter.php">Nous contacter</a></li> -->
      </ul>
      <ul class="navbar-nav">
<?php
    //* deconnection || connection et inscription
        if(isset($_SESSION['grade'])){
          echo '<li class="nav-item"><a class="nav-link" href="includes/logout.php">Déconnection</a></li>';
        }else{
          echo '<li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>';
        }
?>
        
        
      </ul>
    </div>
  </div>
</nav>