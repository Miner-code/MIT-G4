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
<?php include('../include/bdd.php');
      include "../include/nav-admin.php";

      $sql_etab="SELECT * FROM etablissement";
    $req=$bdd->query($sql_etab);
    $req->execute();   
    $resultat=$req->fetchAll();
?>
      <div class="container_user">
      <h2>Etablissement</h2>

    <table>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>profil</th>
            <th>banniere</th>
            <th></th>
        </tr>
        
        <?php
        foreach ($resultat as $row) {?>
                        <tr>
                <td> <?=$row["nom_etab"]?> </td>
                <td><?=$row["adresse_etab"] ?> </td>
                <td> <?=$row["profil_etab"]?> </td>
                <td><?= $row["banniere_etab"] ?></td>
                <td><button id="menu" ><img src="../icone/paint-brush-alt.svg"></button></td>
                <td><button id="" ><img src="../icone/close.svg"></button></td>
              </tr>
            <?php }
                ?>
                </table>
                <?php ?>
 </div>

 