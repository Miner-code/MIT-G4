<?php
    session_start();
    include "include/bdd.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["message"])) {
            $message = $_POST["message"];

            
        }
    }