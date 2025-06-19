<?php
class DemandeModel {
    private string $id;
    private string $etudiant_id;
    private string $inscription_id;
    private string $type_demande;
    private string $motif;
    private string $date_demande;
    private string $statut;
    private ?string $traite_par;
    private ?string $date_traitement;
    private string $created_at;

    public function __construct(
        string $id,
        string $etudiant_id,
        string $inscription_id,
        string $type_demande,
        string $motif,
        string $date_demande,
        string $statut,
        ?string $traite_par = null,
        ?string $date_traitement = null,
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->etudiant_id = $etudiant_id;
        $this->inscription_id = $inscription_id;
        $this->type_demande = $type_demande;
        $this->motif = $motif;
        $this->date_demande = $date_demande;
        $this->statut = $statut;
        $this->traite_par = $traite_par;
        $this->date_traitement = $date_traitement;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getEtudiantId(): string { return $this->etudiant_id; }
    public function getInscriptionId(): string { return $this->inscription_id; }
    public function getTypeDemande(): string { return $this->type_demande; }
    public function getMotif(): string { return $this->motif; }
    public function getDateDemande(): string { return $this->date_demande; }
    public function getStatut(): string { return $this->statut; }
    public function getTraitePar(): ?string { return $this->traite_par; }
    public function getDateTraitement(): ?string { return $this->date_traitement; }
    public function getCreatedAt(): string { return $this->created_at; }

    // Setters
    public function setStatut(string $statut): void { $this->statut = $statut; }
    public function setTraitePar(string $traite_par): void { $this->traite_par = $traite_par; }
    public function setDateTraitement(string $date_traitement): void { $this->date_traitement = $date_traitement; }
}
?>