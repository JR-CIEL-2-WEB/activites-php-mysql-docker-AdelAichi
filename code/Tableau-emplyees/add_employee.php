<?php
include('config.php');

// Récupérer les données de l'employé depuis la requête POST
$data = json_decode(file_get_contents('php://input'), true);

$nom = $data['nom'];
$prenom = $data['prenom'];
$adresse = $data['adresse'];
$salaire = $data['salaire'];

// Insertion dans la table Employes
$sql = "INSERT INTO Employes (nom, prenom, adresse) VALUES ('$nom', '$prenom', '$adresse')";
if ($conn->query($sql) === TRUE) {
    // Récupérer l'ID de l'employé inséré
    $employe_id = $conn->insert_id;

    // Insertion dans la table Salary
    $sql_salary = "INSERT INTO Salary (employe_id, salaire) VALUES ($employe_id, $salaire)";
    $conn->query($sql_salary);

    echo json_encode(["status" => "success", "employe_id" => $employe_id]);
} else {
    echo json_encode(["status" => "error", "message" => "Erreur d'ajout"]);
}

$conn->close();
?>
