<?php
class EtudiantModel {
    private string $id;
    private string $matricule;
    private string $nom;
    private string $prenom;
    private string $sexe;
    private string $adresse;
    private string $email;
    private ?string $userId;
    private string $created_at;

    public function __construct(
        string $id,
        string $matricule,
        string $nom,
        string $prenom,
        string $sexe,
        string $adresse,
        string $email,
        ?string $userId = null,
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->userId = $userId;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getMatricule(): string { return $this->matricule; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getSexe(): string { return $this->sexe; }
    public function getAdresse(): string { return $this->adresse; }
    public function getEmail(): string { return $this->email; }
    public function getUserId(): ?string { return $this->userId; }
    public function getCreatedAt(): string { return $this->created_at; }
    public function getNomComplet(): string { return $this->nom . ' ' . $this->prenom; }

    // Setters
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setSexe(string $sexe): void { $this->sexe = $sexe; }
    public function setAdresse(string $adresse): void { $this->adresse = $adresse; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setUserId(?string $userId): void { $this->userId = $userId; }
}
?>