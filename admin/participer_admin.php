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

      $sql_participer="SELECT * FROM participer";
    $req=$bdd->query($sql_participer);
    $req->execute();   
    $resultat=$req->fetchAll();
?>
      <div class="container_user">
      <h2>Participer</h2>

    <table>
        <tr>
            <th>id_user</th>
            <th>id_cursus</th>
            <th>id_etab</th>
            <th>date_début</th>
            <th>date_fin</th>
            <th></th>
        </tr>
        
        <?php
        foreach ($resultat as $row) {?>
                        <tr>
                <td> <?=$row["id_user"]?> </td>
                <td><?=$row["id_cursus"] ?> </td>
                <td> <?=$row["id_etab"]?> </td>
                <td><?= $row["date_debut"] ?></td>
                <td><?= $row["date_fin"] ?></td>
                <td><button id="menu" ><img src="../icone/paint-brush-alt.svg"></button></td>
                <td><button id="" ><img src="../icone/close.svg"></button></td>
              </tr>
            <?php }
                ?>
                </table>
                <?php ?>
 </div>

 