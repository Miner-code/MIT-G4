<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <script src="js/admin.js"></script>
    <title>Document</title>
</head>
<body>
<?php include "../include/bdd.php" ;
      include "../include/nav-admin.php";

      $sql_user="SELECT user.id_user,user.nom_user,user.prenom_user, user.mail_user,user.dtn_user,etablissement.nom_etab,ville.nom_ville
                FROM user INNER JOIN participer on participer.id_user=user.id_user 
                INNER JOIN etablissement ON etablissement.id_etab=participer.id_etab 
                INNER JOIN ville on ville.id_ville=etablissement.id_ville";
    $req=$bdd->query($sql_user);
    $req->execute();   
    $resultat=$req->fetchAll();
    //////////////////////////////////
    if(!empty($_POST)){
      
    $sql_update="UPDATE user SET nom_user=?, prenom_user=?, mail_user=?, where id_user = ?";
    try{
      $data=array($_POST["nom"],$_POST["prenom"],$_POST["mail"],$_POST['id']);
      $req_update=$pdo->prepare($sql_update);
      $req_update->execute($data);
      $resultat=$req_update->fetchAll();
      header("Location: admin.php");
    }
    catch(Exception $e){
      echo"erreur de requête : ",$e->getMessage();
           
    }
  }
    ///////////
?>

 <div class="container_user">
      <h2>Users</h2>
      <form action="" method="post" id="form1">
    <table>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Age</th>
            <th>Etablissement</th>
            <th>Ville</th>
            <th></th>
        </tr>

        <?php
        foreach ($resultat as $row) {
          
            ?>
                <tr>
                <td> <input name="nom" value=<?=$row["nom_user"]?>   id="info" disabled></input> </td>
                <td><input name="prenom" value=<?=$row["prenom_user"] ?>  id="info" disabled></input> </td>
                <td><input name="mail" value=<?=$row["mail_user"]?>  id="info" disabled></input></td>
                <td><input name="age" value=<?=$row['dtn_user'] ?>  id="info" disabled></input></td>
                <td><input name="nom_etab" value=<?=$row["nom_etab"]?>  id="info" disabled></input> </td>
                <td><input name="nom_ville" value=<?= $row["nom_ville"] ?>  id="info" disabled></input></td>
                <td><button id="menu" form="form" ><img src="../icone/paint-brush-alt.svg"></button><button type="submit" id="submit" form="form1" style="display: none;"><img src="../icone/check.svg"></button></td>
                <td><button id="" ><img src="../icone/close.svg"></button></td>
              </tr>
            <?php }
        ?>
       
    </table>
    </form> 
        
    <script>
 // Créez une fonction pour activer ou désactiver les champs d'entrée dans une ligne.
function toggleRowInputs(row) {
    // Obtenez tous les champs d'entrée dans la ligne.
    const inputs = row.querySelectorAll('input');

    // Activez ou désactivez l'état désactivé de tous les champs d'entrée.
    inputs.forEach(input => {
        input.disabled = !input.disabled;
    });
}

// Ajoutez un écouteur d'événement "click" à chaque bouton dans le tableau.
document.querySelectorAll('#menu').forEach(button => {
    button.onclick = function() {
        // Obtenez la ligne dans laquelle se trouve le bouton.
        const row = button.closest('tr');

        // Appelez la fonction toggleRowInputs.
        toggleRowInputs(row);

        // Masquez le bouton "menu".
        button.style.display = 'none';

        // Affichez le bouton "soumettre".
        document.getElementById('submit').style.display = 'block';
    };
});


    </script>

    <?php ?>
 </div>