<?php

class Room {
    // Propriétés privées
    private int $id;
    private string $number;
    private int $floor_id;

    // Constructeur
    public function __construct(int $id = 0, string $number = '', int $floor_id = 0) {
        $this->id = $id;
        $this->number = $number;
        $this->floor_id = $floor_id;
    }

    // Getters et Setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function setNumber(string $number): void {
        $this->number = $number;
    }

    public function getFloorId(): int {
        return $this->floor_id;
    }

    public function setFloorId(int $floor_id): void {
        $this->floor_id = $floor_id;
    }

    // Méthode pour afficher les informations de la salle
    public function displayRoomInfo(): void {
        echo "Room ID: " . $this->getId() . "\n";
        echo "Room Number: " . $this->getNumber() . "\n";
        echo "Floor ID: " . $this->getFloorId() . "\n";
    }
}
