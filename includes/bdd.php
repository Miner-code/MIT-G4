<?php

try{
    $bdd = new PDO('mysql:host=localhost;dbname=PhotoForYou;charset=utf8','root','');
}catch(PDOException $e){
    die(print_r("Erreur bdd:".$e->getMessage()));
}

?>