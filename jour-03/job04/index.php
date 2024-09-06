<?php

// Inclure les fichiers nécessaires
require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'class/Floor.php';
require_once 'functions.php';

// Test des fonctions

// Trouver un étudiant avec l'ID 1
$student = findOneStudent(1);
if ($student) {
    $student->displayStudentInfo();
} else {
    echo "Aucun étudiant trouvé.\n";
}

echo "\n";

// Trouver un grade avec l'ID 1
$grade = findOneGrade(1);
if ($grade) {
    $grade->displayGradeInfo();
} else {
    echo "Aucun grade trouvé.\n";
}

echo "\n";

// Trouver un étage avec l'ID 1
$floor = findOneFloor(1);
if ($floor) {
    $floor->displayFloorInfo();
} else {
    echo "Aucun étage trouvé.\n";
}

echo "\n";

// Trouver une salle avec l'ID 1
$room = findOneRoom(1);
if ($room) {
    $room->displayRoomInfo();
} else {
    echo "Aucune salle trouvée.\n";
}
