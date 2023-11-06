<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("location:home.php");
} else {
    header("location:connexion.php");
}
