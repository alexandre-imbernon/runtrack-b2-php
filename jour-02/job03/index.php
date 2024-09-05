<?php
include 'db.php'; // Inclusion du fichier db.php

// Instanciation de la classe DataBase pour établir la connexion
$db = new DataBase();
$conn = $db->getConnection();

// Fonction pour insérer un nouvel étudiant en base de données
function insert_student($email, $fullname, $gender, $birthdate, $grade_id) {
    global $conn;

    try {
        // Préparation de la requête SQL avec des paramètres
        $stmt = $conn->prepare("INSERT INTO student (email, fullname, gender, birthdate, grade_id) VALUES (?, ?, ?, ?, ?)");

        // Liaison des paramètres
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $fullname);
        $stmt->bindParam(3, $gender);
        $stmt->bindParam(4, $birthdate);
        $stmt->bindParam(5, $grade_id);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "Étudiant ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout de l'étudiant.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Traitement du formulaire lors de l'envoi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['input-email'];
    $fullname = $_POST['input-fullname'];
    $gender = $_POST['input-gender'];
    $birthdate = $_POST['input-birthdate'];
    $grade_id = $_POST['input-grade_id'];

    // Appel de la fonction pour insérer l'étudiant
    insert_student($email, $fullname, $gender, $birthdate, $grade_id);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
</head>
<body>
    <h1>Ajouter un nouvel étudiant</h1>
    
    <!-- Formulaire pour ajouter un étudiant -->
    <form method="POST" action="index.php">
        <label for="email">Email :</label>
        <input type="email" id="email" name="input-email" required><br><br>
        
        <label for="fullname">Nom complet :</label>
        <input type="text" id="fullname" name="input-fullname" required><br><br>

        <label for="gender">Sexe :</label>
        <select id="gender" name="input-gender" required>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
        </select><br><br>

        <label for="birthdate">Date de naissance :</label>
        <input type="date" id="birthdate" name="input-birthdate" required><br><br>

        <label for="grade_id">ID de la classe :</label>
        <input type="number" id="grade_id" name="input-grade_id" required><br><br>

        <input type="submit" value="Ajouter l'étudiant">
    </form>
</body>
</html>
