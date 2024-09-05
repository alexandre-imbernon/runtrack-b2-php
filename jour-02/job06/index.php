<?php
include 'db.php'; // Inclusion du fichier db.php

// Instanciation de la classe DataBase pour établir la connexion
$db = new DataBase();
$conn = $db->getConnection();

// Fonction pour récupérer les promotions et les étudiants triés par taille
function find_ordered_students() {
    global $conn;

    try {
        // Requête SQL pour récupérer les informations des promotions, étudiants et trier par taille de promotion
        $sql = "
            SELECT g.name AS grade_name, g.id AS grade_id, s.id AS student_id, s.email, s.fullname, s.birthdate, s.gender
            FROM grade g
            LEFT JOIN student s ON g.id = s.grade_id
            GROUP BY g.id, s.id
            ORDER BY (SELECT COUNT(*) FROM student WHERE grade_id = g.id) DESC, g.name
        ";

        // Exécution de la requête
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Organiser les données pour grouper les étudiants par promotion
        $grades = [];
        foreach ($students as $student) {
            $grade_name = $student['grade_name'];
            if (!isset($grades[$grade_name])) {
                $grades[$grade_name] = [
                    'grade_id' => $student['grade_id'],
                    'students' => []
                ];
            }
            $grades[$grade_name]['students'][] = [
                'student_id' => $student['student_id'],
                'email' => $student['email'],
                'fullname' => $student['fullname'],
                'birthdate' => $student['birthdate'],
                'gender' => $student['gender']
            ];
        }

        // Trier les promotions par taille
        usort($grades, function($a, $b) {
            return count($b['students']) - count($a['students']);
        });

        return $grades;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Appel de la fonction pour récupérer les données
$grades_data = find_ordered_students();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants par promotion</title>
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
    <h1>Liste des étudiants par promotion</h1>

    <!-- Tableau pour afficher les données des promotions -->
    <?php foreach ($grades_data as $grade_name => $grade_data) : ?>
        <h2>Promotion: <?php echo htmlspecialchars($grade_name); ?></h2>
        <table>
            <thead>
                <tr>
                    <th>ID Étudiant</th>
                    <th>Email</th>
                    <th>Nom Complet</th>
                    <th>Date de Naissance</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($grade_data['students'])) : ?>
                    <?php foreach ($grade_data['students'] as $student) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($student['birthdate']); ?></td>
                            <td><?php echo htmlspecialchars($student['gender']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Aucun étudiant trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</body>
</html>
