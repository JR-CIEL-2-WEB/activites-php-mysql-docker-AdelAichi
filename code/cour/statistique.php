<?php
function moyenne($donnees) {
    if (empty($donnees)) {
        return 0;
    }
    return round(array_sum($donnees) / count($donnees)); 
}
function mediane($donnees) {
    $nbElements = count($donnees);
    if ($nbElements === 0) {
        return 0;
    }
    sort($donnees);
    $milieu = floor($nbElements / 2);
    if ($nbElements % 2 === 0) {
        return round(($donnees[$milieu - 1] + $donnees[$milieu]) / 2); 
    } else {
        return round($donnees[$milieu]); 
    }
}
?>
