<?php
include 'db.php';

function find_all_students() : array {
    $db = new DataBase();
    $conn = $db->getConnection();

    try {
        $stmt = $conn->query("SELECT * FROM student");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
</head>
<body>
    <h1>Liste des Étudiants</h1>
    <?php if ($students = find_all_students()): ?>
        <table border="1">
            <tr><th>ID</th><th>Grade</th><th>Nom</th><th>Email</th><th>Sexe</th><th>Date de Naissance</th></tr>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['id']) ?></td>
                    <td><?= htmlspecialchars($s['grade_id']) ?></td>
                    <td><?= htmlspecialchars($s['fullname']) ?></td>
                    <td><?= htmlspecialchars($s['email']) ?></td>
                    <td><?= htmlspecialchars($s['gender']) ?></td>
                    <td><?= htmlspecialchars($s['birthdate']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun étudiant trouvé.</p>
    <?php endif; ?>
</body>
</html>
