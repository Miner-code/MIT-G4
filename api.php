<?php
if (!empty($_GET['id_etab'])) {
    getImpressionByEtab($_GET['id_etab']);
} else if (!empty($_GET['id_theme'])) {
    getImpressionByTheme($_GET['id_theme']);
}

function getImpressionByEtab($etab) {
    include "include/bdd.php";       
    $req = $bdd->query("SELECT * FROM impression
     INNER JOIN user ON user.id_user = impression.id_user
     INNER JOIN participer ON user.id_user = participer.id_user
     INNER JOIN etablissement ON participer.id_etab = etablissement.id_etab
     WHERE etablissement.id_etab = $etab ORDER BY date_imp DESC");
    $req->execute();
    $data = $req->fetchAll();
    echo(json_encode($data));
    return;
}

function getImpressionByTheme($theme) {
    include "include/bdd.php";
    $req = $bdd->query("SELECT * FROM impression INNER JOIN user ON user.id_user = impression.id_user WHERE id_theme = $theme ORDER BY date_imp DESC");
    $req->execute();
    $data = $req->fetchAll();
    echo(json_encode($data));
    return;
}

?>