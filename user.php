<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Document</title>
</head>
<body>
<?php include "include/bdd.php" ;
      include "include/nav-admin.php";

      $sql_user="SELECT user.nom_user,user.prenom_user, user.mail_user,user.dtn_user,etablissement.nom_etab,ville.nom_ville
                FROM user INNER JOIN participer on participer.id_user=user.id_user 
                INNER JOIN etablissement ON etablissement.id_etab=participer.id_etab 
                INNER JOIN ville on ville.id_ville=etablissement.id_ville";
    $req=$bdd->query($sql_user);
    $req->execute();   
    $resultat=$req->fetchAll();
    //var_dump($resultat);
    
?>
 <div class="container_user">
      <h2>Users</h2>

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
                <td> <?=$row["nom_user"]?> </td>
                <td><?=$row["prenom_user"] ?> </td>
                <td> <?=$row["mail_user"]?> </td>
                <td><?=$age ?>ans</td>
                <td><?=$row["nom_etab"]?> </td>
                <td><?= $row["nom_ville"] ?></td>
                <td><img src="icone/menu.svg"></td>
              </tr>
            <?php }
        ?>
    </table>
    <?php ?>
 </div>