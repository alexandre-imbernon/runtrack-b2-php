<?php

class Floor {
    // Propriétés privées
    private int $id;
    private string $level;

    // Constructeur
    public function __construct(int $id = 0, string $level = '') {
        $this->id = $id;
        $this->level = $level;
    }

    // Getters et Setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getLevel(): string {
        return $this->level;
    }

    public function setLevel(string $level): void {
        $this->level = $level;
    }

    // Méthode pour afficher les informations de l'étage
    public function displayFloorInfo(): void {
        echo "Floor ID: " . $this->getId() . "\n";
        echo "Floor Level: " . $this->getLevel() . "\n";
    }
}
