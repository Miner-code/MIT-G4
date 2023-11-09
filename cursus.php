<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <script src="js/admin.js"></script>
    <title>Document</title>
</head>
<body>
<?php include "include/bdd.php" ;
      include "include/nav-admin.php";

      $sql_participer="SELECT * FROM cursus";
    $req=$bdd->query($sql_participer);
    $req->execute();   
    $resultat=$req->fetchAll();
?>
      <div class="container_user">
      <h2>Participer</h2>

    <table>
        <tr>
            <th>libelle_cursus</th>
            <th>spe_cursus</th>
       
            <th></th>
        </tr>
        
        <?php
        foreach ($resultat as $row) {?>
                        <tr>
                <td> <?=$row["libelle_cursus"]?> </td>
                <td><?=$row["spe_cursus"] ?> </td>
                
                <td><button id="menu" ><img src="icone/menu.svg"></button></td>
              </tr>
            <?php }
                ?>
                </table>
                <?php ?>
 </div>

 