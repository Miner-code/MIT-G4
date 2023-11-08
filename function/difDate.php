<?php
    function publieDepuis($datePublication) {
        $datePubliee = DateTime::createFromFormat('Y-m-d H:i:s', $datePublication);
    
        if (!$datePubliee) {
            return "Format de date invalide";
        }
    
        $maintenant = new DateTime();
        $intervalle = $maintenant->diff($datePubliee);
    
        $intervalSpecs = [
            'an' => $intervalle->y,
            'mois' => $intervalle->m,
            'jour' => $intervalle->d,
            'heure' => $intervalle->h,
            'minute' => $intervalle->i,
            'seconde' => $intervalle->s
        ];
    
        foreach ($intervalSpecs as $unite => $valeur) {
            if ($valeur > 0) {
                $pluriel = $valeur > 1 ? 's' : '';
                return "Publié il y a $valeur $unite$pluriel";
            }
        }
    
        return "Publié il y a moins d'une seconde";
    }
?>
