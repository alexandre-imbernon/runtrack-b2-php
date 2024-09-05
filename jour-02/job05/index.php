<?php
include 'db.php'; // Inclusion du fichier db.php

// Instanciation de la classe DataBase pour établir la connexion
$db = new DataBase();
$conn = $db->getConnection();

// Fonction pour récupérer les informations des salles et vérifier si elles sont pleines
function find_full_rooms() {
    global $conn;

    try {
        // Requête SQL pour récupérer les noms des salles, leur capacité, le nombre d'étudiants
        $sql = "
            SELECT r.name AS room_name, r.capacity, COUNT(s.id) AS student_count
            FROM room r
            LEFT JOIN grade g ON g.room_id = r.id
            LEFT JOIN student s ON s.grade_id = g.id
            GROUP BY r.id
        ";

        // Exécution de la requête
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Récupération des résultats sous forme de tableau associatif
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ajouter une colonne pour indiquer si la salle est pleine
        foreach ($rooms as &$room) {
            $room['is_full'] = $room['student_count'] >= $room['capacity'] ? 'Oui' : 'Non';
        }

        return $rooms;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Appel de la fonction pour récupérer les données
$rooms_data = find_full_rooms();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des salles</title>
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
    <h1>Liste des salles et leur état</h1>

    <!-- Tableau pour afficher les données des salles -->
    <table>
        <thead>
            <tr>
                <th>Nom de la Salle</th>
                <th>Capacité</th>
                <th>Étudiants Présents</th>
                <th>Est Pleine</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rooms_data)) : ?>
                <?php foreach ($rooms_data as $room) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($room['room_name']); ?></td>
                        <td><?php echo htmlspecialchars($room['capacity']); ?></td>
                        <td><?php echo htmlspecialchars($room['student_count']); ?></td>
                        <td><?php echo htmlspecialchars($room['is_full']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Aucune salle trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
