<?php

class Student {
    // Déclaration des attributs
    private int $id;
    private int $grade_id;
    private string $email;
    private string $fullname;
    private DateTime $birthdate;
    private string $gender;

    // Constructeur avec des paramètres optionnels
    public function __construct(int $id = 0, int $grade_id = 0, string $email = '', string $fullname = '', string $birthdate = 'now', string $gender = '') {
        $this->id = $id;
        $this->grade_id = $grade_id;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->birthdate = new DateTime($birthdate);
        $this->gender = $gender;
    }

    // Getters et Setters pour chaque attribut

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getGradeId(): int {
        return $this->grade_id;
    }

    public function setGradeId(int $grade_id): void {
        $this->grade_id = $grade_id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getFullname(): string {
        return $this->fullname;
    }

    public function setFullname(string $fullname): void {
        $this->fullname = $fullname;
    }

    public function getBirthdate(): DateTime {
        return $this->birthdate;
    }

    public function setBirthdate(string $birthdate): void {
        $this->birthdate = new DateTime($birthdate);
    }

    public function getGender(): string {
        return $this->gender;
    }

    public function setGender(string $gender): void {
        $this->gender = $gender;
    }

    // Méthode pour afficher les informations de l'étudiant
    public function displayStudentInfo(): void {
        echo "ID: " . $this->id . "\n";
        echo "Grade ID: " . $this->grade_id . "\n";
        echo "Email: " . $this->email . "\n";
        echo "Full Name: " . $this->fullname . "\n";
        echo "Birthdate: " . $this->birthdate->format('Y-m-d') . "\n";
        echo "Gender: " . $this->gender . "\n";
    }
}
