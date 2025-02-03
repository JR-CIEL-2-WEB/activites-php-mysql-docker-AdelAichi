<?php
// Configuration de la base de données
$servername = "mysql"; // Adresse du serveur de base de données
$username = "eleve"; // Nom d'utilisateur de la base de données
$password = "eleve"; // Mot de passe de la base de données
$dbname = "appdb"; // Nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
?>
