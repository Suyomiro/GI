<?php
class EtudiantDashboardModel {
    private string $id;
    private string $matricule;
    private string $nom;
    private string $prenom;
    private string $sexe;
    private string $adresse;
    private string $email;

    public function __construct(
        string $id,
        string $matricule,
        string $nom,
        string $prenom,
        string $sexe,
        string $adresse,
        string $email
    ) {
        $this->id = $id;
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->adresse = $adresse;
        $this->email = $email;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getMatricule(): string { return $this->matricule; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getSexe(): string { return $this->sexe; }
    public function getAdresse(): string { return $this->adresse; }
    public function getEmail(): string { return $this->email; }
    public function getNomComplet(): string { return $this->nom . ' ' . $this->prenom; }
}
?>