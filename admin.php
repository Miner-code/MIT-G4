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
     
//requete count user
       $sql_nb_user = "SELECT COUNT(id_user) FROM user";
       $result_user = $bdd->query($sql_nb_user);

       $nombreUtilisateurs = $result_user->fetchColumn();
//requete count post 
       $sql_nb_post = "SELECT COUNT(id_imp) FROM impression";
       $result_post = $bdd->query($sql_nb_post);

       $nombrePost = $result_post->fetchColumn();
//requete count ecole    
       $sql_nb_ecole = "SELECT COUNT(nom_etab) FROM etablissement";
       $result_ecole = $bdd->query($sql_nb_ecole);

       $nombreEcole = $result_ecole->fetchColumn();

//requete last post 
$sql_last_post ="SELECT impression.titre_imp,user.nom_user,user.prenom_user  FROM impression INNER JOIN user on user.id_user=impression.id_user
                 ORDER BY impression.id_imp DESC 
                 LIMIT 1";
$result_last=$bdd->query($sql_last_post);

while ($row = $result_last->fetch(PDO::FETCH_ASSOC)) {

?>


<div class="grid-container">
<div class="container">
        <li>Nb users :<?=" ".$nombreUtilisateurs ?> </li>
        <li>Nb posts :<?=" ".$nombrePost?></li>
        <li>Nb schools :<?=" ".$nombreEcole?></li>
    </div>

    <div class="container">
        <li>Last post :<?=" post: ".$row["titre_imp"]." nom:".$row["nom_user"]." prenom".$row["prenom_user"] ; }?></li>
       
    </div>

    <div class="bottom-container container">
        <li>Evolution de visite du site </li>
    </div>
</div>
 ?>
 
  

</body>
</html>