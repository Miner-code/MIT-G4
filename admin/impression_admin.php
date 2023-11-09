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

    $sql_imp="SELECT * FROM impression";
    $req=$bdd->query($sql_imp);
    $req->execute();   
    $resultat=$req->fetchAll();
?>
      <div class="container_user">
      <h2>Impression</h2>

    <table>
        <tr>
            <th>titre_imp</th>
            <th>contenue_imp</th>
            <th>date_imp</th>
            <th>id_theme</th>
            <th>id_user</th>
            <th></th>
        </tr>
        
        <?php
        foreach ($resultat as $row) {?>
                        <tr>
                <td> <?=$row["titre_imp"]?> </td>
                <td><?=$row["contenu_imp"] ?> </td>
                <td> <?=$row["date_imp"]?> </td>
                <td><?= $row["id_theme"] ?></td>
                <td><?= $row["id_user"] ?></td>
                <td><button id="menu" form="form" ><img src="../icone/paint-brush-alt.svg"></button><button type="submit" id="submit" form="form1" style="display: none;"><img src="../icone/check.svg"></button></td>
                <td><button id="" ><img src="../icone/close.svg"></button></td>
              </tr>
            <?php }
                ?>
                </table>
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

 