<?php
include('config.php');

// Récupérer les employés avec leur salaire de la base de données
$sql = "SELECT E.employe_id, E.nom, E.prenom, E.adresse, S.salaire
        FROM Employes E
        LEFT JOIN Salary S ON E.employe_id = S.employe_id";
$result = $conn->query($sql);

$employees = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Renvoyer les résultats sous forme de JSON
echo json_encode($employees);

$conn->close();
?>
