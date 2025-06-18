<?php
// Représente les données liées à l'utilisateur pour le header.
class HeaderModel {
    private string $role;

    public function __construct(string $role) {
        $this->role = $role;
    }

    public function getRole(): string {
        return $this->role;
    }
}
