<?php
include('config.php');

// Récupérer les données de l'employé depuis la requête POST
$data = json_decode(file_get_contents('php://input'), true);

$employe_id = $data['employe_id'];
$nom = $data['nom'];
$prenom = $data['prenom'];
$adresse = $data['adresse'];
$salaire = $data['salaire'];

// Mise à jour des informations de l'employé
$sql = "UPDATE Employes SET nom='$nom', prenom='$prenom', adresse='$adresse' WHERE employe_id=$employe_id";
if ($conn->query($sql) === TRUE) {
    // Mise à jour du salaire
    $sql_salary = "UPDATE Salary SET salaire=$salaire WHERE employe_id=$employe_id";
    $conn->query($sql_salary);

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erreur de mise à jour"]);
}

$conn->close();
?>
