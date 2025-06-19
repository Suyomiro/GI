<?php
class ProfesseurModel {
    private string $id;
    private string $nom;
    private string $prenom;
    private string $grade;
    private string $created_at;

    public function __construct(string $id, string $nom, string $prenom, string $grade, string $created_at = '') {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->grade = $grade;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getGrade(): string { return $this->grade; }
    public function getCreatedAt(): string { return $this->created_at; }
    public function getNomComplet(): string { return $this->nom . ' ' . $this->prenom; }

    // Setters
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setGrade(string $grade): void { $this->grade = $grade; }
}
?>