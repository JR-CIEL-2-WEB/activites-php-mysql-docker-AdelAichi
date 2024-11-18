<?php
include 'statistique.php';

$salaires = [1500, 4500, 2200, 1500, 3300, 1500, 1700,2000,4000];

$moyenneSalaires = moyenne($salaires);
$medianeSalaires = mediane($salaires);

echo "La moyenne des salaires est : " . $moyenneSalaires . " €.<br>";
echo "La médiane des salaires est : " . $medianeSalaires . " €.<br>";

echo "Réponse à la question de Nicolas : Non ton salaire ne fait pas partie des moin bien elevé.";
?>
