<?php
class ClasseModel {
    private string $id;
    private string $libelle;
    private string $filiere;
    private string $niveau;
    private string $created_at;

    public function __construct(string $id, string $libelle, string $filiere, string $niveau, string $created_at = '') {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->filiere = $filiere;
        $this->niveau = $niveau;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getLibelle(): string { return $this->libelle; }
    public function getFiliere(): string { return $this->filiere; }
    public function getNiveau(): string { return $this->niveau; }
    public function getCreatedAt(): string { return $this->created_at; }

    // Setters
    public function setLibelle(string $libelle): void { $this->libelle = $libelle; }
    public function setFiliere(string $filiere): void { $this->filiere = $filiere; }
    public function setNiveau(string $niveau): void { $this->niveau = $niveau; }
}
?>