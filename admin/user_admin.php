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
    $sql_update="UPDATE user SET nom_user=?, prenom_user=?, mail_user=?, dtn_user=? where id_user = ?";
    try{
      $data=array($_POST["nom"],$_POST["prenom"],$_POST["mail"],$_POST["dtn_user"],$_POST['id']);
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
      <form action="" method="post">
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
            $dateNaissance = $row['dtn_user'];
            $aujourdhui = new DateTime();
            $dateNaissance = new DateTime($dateNaissance);
            $difference = $aujourdhui->diff($dateNaissance);
            $age = $difference->y
            ?>
                <tr>
                <td> <input name="nom" value=<?=$row["nom_user"]?>   id="info" disabled></input> </td>
                <td><input name="prenom" value=<?=$row["prenom_user"] ?>  id="info" disabled></input> </td>
                <td><input name="mail" value=<?=$row["mail_user"]?>  id="info" disabled></input></td>
                <td><input name="age" value=<?=$age."ans" ?>  id="info" disabled></input></td>
                <td><input name="nom_etab" value=<?=$row["nom_etab"]?>  id="info" disabled></input> </td>
                <td><input name="nom_ville" value=<?= $row["nom_ville"] ?>  id="info" disabled></input></td>
                <td><button id="menu" ><img src="../icone/paint-brush-alt.svg"></button></td>
                <td><button id="" ><img src="../icone/close.svg"></button></td>
              </tr>
            <?php }
        ?>
       
    </table>
    </form> 
        
    <script>
  // Create a function to enable or disable the input fields in a row.
function toggleRowInputs(row) {
    // Get all of the input fields in the row.
    const inputs = row.querySelectorAll('input');

    // Toggle the disabled state of all of the input fields.
    inputs.forEach(input => {
        input.disabled = !input.disabled;
    });
}

// Add an onclick event listener to each button in the table.
document.querySelectorAll('#menu').forEach(button => {
    button.onclick = function() {
        // Get the row that the button is in.
        const row = button.closest('tr');

        // Toggle the disabled state of the input fields in the row.
        toggleRowInputs(row);
    };
});
  
    </script>

    <?php ?>
 </div>