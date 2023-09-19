<?php
session_start();
if(empty($_SESSION['grade'])){
    header('location:index.php');
    exit();
}
if($_SESSION['grade'] != 'admin'){
	header('location:index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Gestion des utilisateurs</title>
	<?php include "includes/head.php"; ?>
</head>
	<body>
		<?php 
		include "includes/bdd.php";
		include "includes/nav.php"; 
		?>
		<h1 class="text-center mt-4">Gestion Utilisateur</h1>
        <div class="row justify-content-center mt-4">
            <div class="col-6 text-center">
				<table class="table table-bordered table-striped">
					<tr>
						<td>Id</td>
						<td>Nom</td>
						<td>Prenom</td>
						<td>Mail</td>
						<td>Grade</td>
						<td>Credits</td>
						<td>Etat</td>
					</tr>
					<?php
				//* Liste des utilisateur
        			    $req = $bdd->query("SELECT * FROM User WHERE grade != 'admin'");
        			    $data = $req->fetchAll();
        			    echo '';
        			    foreach ($data as $li){
        			        echo '<tr>';
        			        echo '<td>'.$li['id'].'</td>';
        			        echo '<td>'.$li['nom'].'</td>';
        			        echo '<td>'.$li['prenom'].'</td>';
        			        echo '<td>'.$li['mail'].'</td>';
        			        echo '<td>'.$li['grade'].'</td>';
        			        echo '<td>'.$li['credits'].'</td>';
					// * Affichage en fonction l'état, et renvoit vers modif-etat-user.php avec $_GET['id'] && $_GET['etat']
							if($li['etat'] == 'banni'){
								echo '<td><a href="modif-etat-user.php?id='.$li['id'].'&etat='.$li['etat'].'"><button class="h-100 w-100 btn btn-danger">'.$li['etat'].'</td>';
							}

							if($li['etat'] == 'attValid'){
								echo '<td><a href="modif-etat-user.php?id='.$li['id'].'&etat='.$li['etat'].'"><button class="h-100 w-100 btn btn-warning">'.$li['etat'].'</td>';
							}
						
							if($li['etat'] == 'valid'){
								echo '<td><a href="modif-etat-user.php?id='.$li['id'].'&etat='.$li['etat'].'"><button class="h-100 w-100 btn btn-success">'.$li['etat'].'</td>';
							}
        			        echo '</tr/>';
        			    }
        			?>
				</table>
			</div>
		</div>
		<?php include "includes/footer.php"; ?>
	</body>
</html>