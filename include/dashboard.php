

<?php
       $sql_nb_user = "SELECT COUNT(id_user) FROM user";
       $result_user = $bdd->query($sql_nb_user);

       $nombreUtilisateurs = $result_user->fetchColumn();

       $sql_nb_post = "SELECT COUNT(id_imp) FROM impression";
       $result_post = $bdd->query($sql_nb_post);

       $nombrePost = $result_post->fetchColumn();

       
       $sql_nb_ecole = "SELECT COUNT(nom_etab) FROM etablissement";
       $result_ecole = $bdd->query($sql_nb_ecole);

       $nombreEcole = $result_ecole->fetchColumn();
?>
<div class="container">
        <li>Nb users :<?=$nombreUtilisateurs ?> </li>
        <li>Nb posts :<?=$nombrePost?></li>
        <li>Nb schools :</li>
    </div>

    <div class="container">
        <li>Last post : </li>
       
    </div>

    <div class="container">
        <li>Evolution de visite du site </li>
    </div>