<?php
include 'db.php';

// Fonction pour récupérer les informations d'un étudiant en fonction de l'email
function find_one_student($email) : array {
    $db = new DataBase();
    $conn = $db->getConnection();

    if ($conn === null) {
        echo "Connection failed.";
        return []; // Retourne un tableau vide si la connexion échoue
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM student WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: []; // Retourne un tableau vide si aucun résultat n'est trouvé
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

// Initialisation de la variable pour stocker les informations de l'étudiant
$student = [];
if (isset($_GET['input-email-student'])) {
    // Récupération des informations de l'étudiant en fonction de l'email saisi
    $student = find_one_student($_GET['input-email-student']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Étudiant</title>
</head>
<body>

    <h1>Rechercher un étudiant</h1>

    <!-- Formulaire de recherche par email -->
    <form method="get" action="index.php">
        <label for="email">Email de l'étudiant :</label>
        <input type="text" id="email" name="input-email-student" required>
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des résultats -->
    <?php if (!empty($student)): ?>
        <h2>Informations de l'étudiant :</h2>
        <ul>
            <?php foreach ($student as $key => $value): ?>
                <li><strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif (isset($_GET['input-email-student'])): ?>
        <p>Aucun étudiant trouvé avec cet email.</p>
    <?php endif; ?>

</body>
</html>
