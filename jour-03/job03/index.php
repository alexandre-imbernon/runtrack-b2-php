<?php

// Inclure toutes les classes
require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'class/Floor.php';

// Test de la classe Student
$student1 = new Student();
$student1->displayStudentInfo();

echo "\n";

$student2 = new Student(1, 5, "johndoe@example.com", "John Doe", "2000-05-15", "Male");
$student2->displayStudentInfo();

echo "\n";

// Test de la classe Grade
$grade1 = new Grade();
$grade1->displayGradeInfo();

echo "\n";

$grade2 = new Grade(1, "Grade A");
$grade2->displayGradeInfo();

echo "\n";

// Test de la classe Room
$room1 = new Room();
$room1->displayRoomInfo();

echo "\n";

$room2 = new Room(1, "101", 2);
$room2->displayRoomInfo();

echo "\n";

// Test de la classe Floor
$floor1 = new Floor();
$floor1->displayFloorInfo();

echo "\n";

$floor2 = new Floor(1, "First Floor");
$floor2->displayFloorInfo();
