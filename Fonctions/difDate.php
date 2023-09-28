<?php
function difDate($dateCreation, $heureCreation) {
    if (DateTime::createFromFormat('Y-m-d H:i:s', $dateCreation . ' ' . $heureCreation) !== false) {
        // Convertir la date et l'heure de création en objets DateTime
        $dateCreationObj = new DateTime($dateCreation . ' ' . $heureCreation);
    } else {
        // Gérer l'erreur de format invalide ici
        return "Format de date ou d'heure invalide.";
    }
        
    // Obtenir la date et l'heure actuelles
    $dateActuelleObj = new DateTime();
    
    // Calculer la différence entre les deux dates
    $intervalle = $dateCreationObj->diff($dateActuelleObj);
    
    // Obtenir les composants de l'intervalle
    $ans = $intervalle->y;
    $mois = $intervalle->m;
    $jours = $intervalle->d;
    $heures = $intervalle->h;
    $minutes = $intervalle->i;
    $secondes = $intervalle->s;
    
    // Détermination du plus grand intervalle et son unité
    if ($ans > 0) {
        $plusGrandeUnite = $ans;
        $unite = "an";
        if ($ans > 1) {
            $unite .= "s";
        }
    } elseif ($mois > 0) {
        $plusGrandeUnite = $mois;
        $unite = "mois";
        if ($mois > 1) {
            $unite .= "s";
        }
    } elseif ($jours > 0) {
        $plusGrandeUnite = $jours;
        $unite = "jour";
        if ($jours > 1) {
            $unite .= "s";
        }
    } elseif ($heures > 0) {
        $plusGrandeUnite = $heures;
        $unite = "heure";
        if ($heures > 1) {
            $unite .= "s";
        }
    } elseif ($minutes > 0) {
        $plusGrandeUnite = $minutes;
        $unite = "minute";
        if ($minutes > 1) {
            $unite .= "s";
        }
    } else {
        $plusGrandeUnite = $secondes;
        $unite = "seconde";
        if ($secondes > 1) {
            $unite .= "s";
        }
    }
    
    // Création de la phrase 
    $phrase = "Créé il y a " . $plusGrandeUnite . " " . $unite;
    
    return $phrase;
}// Fin difDate
?>
