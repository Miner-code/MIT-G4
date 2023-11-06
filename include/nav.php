<div class="container-fluid">
    	<div class="row min-vh-100 flex-column flex-md-row">
			<aside class="col-12 col-md-3 col-xl-2 p-0 bg-grey ">
			  	<nav class="navbar navbar-expand-md navbar-light bd-light flex-md-column flex-row align-items-center py-2 text-center sticky-top" id="sidebar">
			    	<div class="text-center p-3">
			      		<img src="assets/img/logoFondTransparent.png" alt="logo UNEA" class="img-fluid my-4 p-1 d-none d-md-block"/>
			    	</div>
			    	<button type="button" class="navbar-toggler border-0 order-1" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
			      		<span class="navbar-toggler-icon"></span>
			    	</button>
			    	<b class="collapse navbar-collapse order-last w-100 links-size" id="nav">
			      	<ul class="navbar-nav flex-column w-100">
						<li class="nav-item">
							<a href="home.php" class="nav-link d-flex align-items-center"><div class="grey-dark"><i class="fa-solid fa-house ms-4 mt-2 me-3 mb-2"></i></div><span class="grey-dark">Acceuil</span></a>
						</li>
<?php
// * If role_user === admin
if (isset($_SESSION['role_user'])) {
  if ($_SESSION['role_user'] === 1) {
?>
						<li class="nav-item">
							<a href="admin.php" class="nav-link d-flex align-items-center"><div class="grey-dark"><i class="fa-solid fa-briefcase ms-4 mt-2 me-3 mb-2"></i></div><span class="grey-dark">Gestion Admin</span></a>
						</li>
<?php
  }
}
?>

<?php
//  * Gestion connexion / deconnexion
// TODO : page profil sur la search bar
if (isset($_SESSION['id_user'])) {
?>
						<li class="nav-item">
							<a href="profil.php" class="nav-link d-flex align-items-center"><div class="grey-dark"><i class="fa-solid fa-user ms-4 mt-2 me-3 mb-2"></i></div><span class="grey-dark">Mon Profil</span></a>
						</li>
						<li class="nav-item">
							<a href="logout.php" class="nav-link d-flex align-items-center"><div class="grey-dark"><i class="fa-solid fa-power-off ms-4 mt-2 me-3 mb-2"></i></div><span class="grey-dark">Déconnection</span></a>
						</li>
<?php
}
?>
			      	</ul>
			    	</b>
			  	</nav>   
			</aside>
<!-- fin navbar -->
				<main class="col px-0 flex-grow-1">
					<div class="container py-3 min-h-for-footer">