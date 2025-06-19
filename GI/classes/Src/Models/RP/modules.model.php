<?php
class ModuleModel {
    private string $id;
    private string $nom;
    private string $created_at;

    public function __construct(string $id, string $nom, string $created_at = '') {
        $this->id = $id;
        $this->nom = $nom;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getCreatedAt(): string { return $this->created_at; }

    // Setters
    public function setNom(string $nom): void { $this->nom = $nom; }
}
?>