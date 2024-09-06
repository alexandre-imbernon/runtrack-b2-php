<?php

// Inclure la classe Student
require_once 'class/student.php';

// Créer une instance avec des valeurs par défaut
$student1 = new Student();
$student1->displayStudentInfo();

echo "\n";

// Créer une instance avec des valeurs initialisées
$student2 = new Student(1, 5, "johndoe@example.com", "John Doe", "2000-05-15", "Male");
$student2->displayStudentInfo();
