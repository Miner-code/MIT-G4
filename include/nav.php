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
						<li class="nav-item">
							<a href="logout.php" class="nav-link d-flex align-items-center"><div class="grey-dark"><i class="fa-solid fa-power-off ms-4 mt-2 me-3 mb-2"></i></div><span class="grey-dark">Déconnection</span></a>
						</li>
			      	</ul>
			    	</b>
			  	</nav>   
			</aside>
<!-- fin navbar -->
				<main class="col px-0 flex-grow-1">

<?php
if (strpos($_SERVER['REQUEST_URI'], 'profil') == false) {
?>
	<header class="bg-grey-light py-3 d-flex flex-row">
		<a href="profil.php?id_user=<?=$_SESSION['id_user']?>" class="rounded-circle p-3 bg-grey ms-3">
			<svg height="24" viewBox="0 0 8 8" width="24" xmlns="http://www.w3.org/2000/svg">
				<path d="m4 0c-1.1 0-2 1.12-2 2.5s.9 2.5 2 2.5 2-1.12 2-2.5-.9-2.5-2-2.5zm-2.09 5c-1.06.05-1.91.92-1.91 2v1h8v-1c0-1.08-.84-1.95-1.91-2-.54.61-1.28 1-2.09 1s-1.55-.39-2.09-1z"/>
			</svg>
		</a>

		<section class="input-group flex-nowrap w-50">
			<span class="input-group-text" id="addon-wrapping">
				<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path d="m0 0h24v24h-24z" fill="#fff" opacity="0"/>
					<path d="m20.71 19.29-3.4-3.39a7.92 7.92 0 0 0 1.69-4.9 8 8 0 1 0 -8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zm-15.71-8.29a6 6 0 1 1 6 6 6 6 0 0 1 -6-6z" fill="#231f20"/>
				</svg>
			</span>
			<input type="text" class="form-control" placeholder="Recherche">
		</section>
		<span></span>
	</header>
<?php
} else {
	?>
	<div style="height:90px;"></div>
	<?php
}
?>


					<div class="container py-3 min-h-for-footer">