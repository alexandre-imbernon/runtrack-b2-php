<?php

class Grade {
    // Propriétés privées
    private int $id;
    private string $name;

    // Constructeur
    public function __construct(int $id = 0, string $name = '') {
        $this->id = $id;
        $this->name = $name;
    }

    // Getters et Setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    // Méthode pour afficher les informations du grade
    public function displayGradeInfo(): void {
        echo "Grade ID: " . $this->getId() . "\n";
        echo "Grade Name: " . $this->getName() . "\n";
    }
}
