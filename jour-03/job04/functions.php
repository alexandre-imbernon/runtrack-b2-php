<?php

// Paramètres de connexion à la base de données
function getDbConnection() {
    $host = 'localhost';      // Hôte de la base de données
    $dbname = 'phpj3db'; // Nom de la base de données
    $username = 'root';       // Nom d'utilisateur
    $password = '';           // Mot de passe

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Définir le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

// Fonction pour récupérer un étudiant par son ID
function findOneStudent(int $id): ?Student {
    $pdo = getDbConnection();

    // Requête SQL
    $sql = "SELECT * FROM student WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Student($result['id'], $result['grade_id'], $result['email'], $result['fullname'], $result['birthdate'], $result['gender']);
    }

    return null; // Retourne null si aucun étudiant n'est trouvé
}

// Fonction pour récupérer un grade par son ID
function findOneGrade(int $id): ?Grade {
    $pdo = getDbConnection();

    // Requête SQL
    $sql = "SELECT * FROM grade WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Grade($result['id'], $result['name']);
    }

    return null; // Retourne null si aucun grade n'est trouvé
}

// Fonction pour récupérer un étage par son ID
function findOneFloor(int $id): ?Floor {
    $pdo = getDbConnection();

    // Requête SQL
    $sql = "SELECT * FROM floor WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Floor($result['id'], $result['level']);
    }

    return null; // Retourne null si aucun étage n'est trouvé
}

// Fonction pour récupérer une salle par son ID
function findOneRoom(int $id): ?Room {
    $pdo = getDbConnection();

    // Requête SQL
    $sql = "SELECT * FROM room WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Room($result['id'], $result['number'], $result['floor_id']);
    }

    return null; // Retourne null si aucune salle n'est trouvée
}
