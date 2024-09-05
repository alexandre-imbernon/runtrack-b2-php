<?php
include 'db.php'; // Inclusion du fichier db.php

// Instanciation de la classe DataBase pour établir la connexion
$db = new DataBase();
$conn = $db->getConnection();

// Fonction pour récupérer les emails, noms complets et noms de promotions
function find_all_students_grades() {
    global $conn;

    try {
        // Requête SQL corrigée pour utiliser le bon nom de colonne
        $sql = "
            SELECT student.email, student.fullname, grade.name AS grade_name
            FROM student
            JOIN grade ON student.grade_id = grade.id
        ";
        
        // Exécution de la requête
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $students;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Appel de la fonction pour récupérer les données
$students_data = find_all_students_grades();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des étudiants et leurs promotions</h1>

    <!-- Tableau pour afficher les données des étudiants -->
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Nom Complet</th>
                <th>Promotion</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students_data)) : ?>
                <?php foreach ($students_data as $student) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($student['grade_name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">Aucun étudiant trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
