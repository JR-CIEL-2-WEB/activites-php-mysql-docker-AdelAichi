<?php
include('config.php');

// Récupérer l'ID de l'employé à supprimer depuis la requête POST
$data = json_decode(file_get_contents('php://input'), true);
$employe_id = $data['employe_id'];

// Supprimer les données de la table Salary et Employes
$sql_salary = "DELETE FROM Salary WHERE employe_id=$employe_id";
$conn->query($sql_salary);

$sql = "DELETE FROM Employes WHERE employe_id=$employe_id";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Erreur de suppression"]);
}

$conn->close();
?>
