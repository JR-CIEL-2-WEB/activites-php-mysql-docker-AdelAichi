<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Employees Details</h1>
    <button class="btn" onclick="addEmployee()">Add Employee</button>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="employeeTable">
            <!-- Les données des employés seront insérées ici -->
        </tbody>
    </table>

    <h2>Médiane des salaires</h2>
    <div id="medianSalary">Calcul en cours...</div>

    <script>
        let employees = [];

        // Fonction pour ajouter un employé (ici, juste un exemple avec des valeurs fixes)
        function addEmployee() {
            const name = prompt('Enter employee name');
            const address = prompt('Enter employee address');
            const salary = prompt('Enter employee salary');

            if (name && address && salary) {
                const newEmployee = {
                    name,
                    address,
                    salary: parseFloat(salary)
                };

                // Ajouter localement dans le tableau
                employees.push(newEmployee);
                renderTable();
                calculateMedianSalary();

                // Ajouter dans la base de données
                fetch('add_employee.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(newEmployee)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Erreur lors de l\'ajout');
                    }
                })
                .catch(err => alert('Erreur de connexion au serveur.'));
            }
        }

        // Fonction pour supprimer un employé
        function deleteEmployee(index) {
            const employee = employees[index];

            // Supprimer localement du tableau
            employees.splice(index, 1);
            renderTable();
            calculateMedianSalary();

            // Supprimer de la base de données
            fetch('delete_employee.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: employee.id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Erreur lors de la suppression');
                }
            })
            .catch(err => alert('Erreur de connexion au serveur.'));
        }

        // Fonction pour modifier un employé
        function editEmployee(index) {
            const employee = employees[index];
            const name = prompt('Enter new name', employee.name);
            const address = prompt('Enter new address', employee.address);
            const salary = prompt('Enter new salary', employee.salary);

            if (name && address && salary) {
                // Mettre à jour localement dans le tableau
                employees[index] = {
                    ...employee,
                    name,
                    address,
                    salary: parseFloat(salary)
                };
                renderTable();
                calculateMedianSalary();

                // Mettre à jour dans la base de données
                fetch('update_employee.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id: employee.id,
                        name,
                        address,
                        salary: parseFloat(salary)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Erreur lors de la mise à jour');
                    }
                })
                .catch(err => alert('Erreur de connexion au serveur.'));
            }
        }

        // Fonction pour afficher le tableau
        function renderTable() {
            const employeeTable = document.getElementById('employeeTable');
            employeeTable.innerHTML = ''; // Vider le tableau avant de réinsérer

            employees.forEach((employee, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${employee.name}</td>
                    <td>${employee.address}</td>
                    <td>${employee.salary}</td>
                    <td>
                        <button class="btn" onclick="editEmployee(${index})">Edit</button>
                        <button class="btn btn-delete" onclick="deleteEmployee(${index})">Delete</button>
                    </td>
                `;
                employeeTable.appendChild(row);
            });
        }

        // Calcul de la médiane des salaires
        function calculateMedianSalary() {
            const salaries = employees.map(employee => employee.salary);
            const count = salaries.length;

            if (count > 0) {
                salaries.sort((a, b) => a - b); // Trier les salaires
                const median = count % 2 === 0
                    ? (salaries[count / 2 - 1] + salaries[count / 2]) / 2
                    : salaries[Math.floor(count / 2)];
                document.getElementById('medianSalary').textContent = `Médiane des salaires : ${median}`;
            } else {
                document.getElementById('medianSalary').textContent = 'Aucun salaire disponible.';
            }
        }

        // Récupérer les données des employés (initialement vide ou des données fictives)
        fetch('config.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('medianSalary').textContent = data.error;
                } else {
                    employees = data.employees; // Remplir les employés depuis le serveur
                    renderTable();
                    calculateMedianSalary();
                }
            })
            .catch(err => {
                document.getElementById('medianSalary').textContent = 'Erreur lors du chargement des données.';
                console.error(err);
            });
    </script>
</body>
</html>


