<?php
// Inclusion des fichiers nécessaires
include 'config.php';
include 'mediane.php';
include 'moyenne.php';
include 'tri_selection.php';

// Récupération des salaires depuis la base de données
$query = $pdo->query("SELECT salaire FROM employees");
$salaires = $query->fetchAll(PDO::FETCH_COLUMN);

// Vérification si des salaires existent
if (!empty($salaires)) {
    echo "<h2>Liste des salaires</h2>";
    echo implode(", ", $salaires) . "<br>";

    // Calcul de la médiane
    echo "<h2>Calcul de la médiane</h2>";
    mediane($salaires);

    // Calcul de la moyenne
    echo "<h2>Calcul de la moyenne</h2>";
    $moyenne = moyenne($salaires);
    echo "La moyenne est de : " . number_format($moyenne, 2) . "<br>";

    // Tri des salaires
    echo "<h2>Salaires triés (par sélection)</h2>";
    tri_selection_reference($salaires);
    echo implode(", ", $salaires) . "<br>";
} else {
    echo "Aucun salaire trouvé dans la base de données.";
}
?>
