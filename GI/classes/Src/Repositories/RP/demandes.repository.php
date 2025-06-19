<?php
require_once __DIR__ . '/../../../../config/database.php';
require_once __DIR__ . '/../../Models/RP/demandes.model.php';

class DemandesRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        $stmt = $this->db->query("
            SELECT d.*, e.nom, e.prenom, e.matricule 
            FROM demandes d
            JOIN etudiants e ON d.etudiant_id = e.id
            ORDER BY d.date_demande DESC
        ");
        return $stmt->fetchAll();
    }

    public function getById(string $id): ?array {
        $stmt = $this->db->prepare("
            SELECT d.*, e.nom, e.prenom, e.matricule 
            FROM demandes d
            JOIN etudiants e ON d.etudiant_id = e.id
            WHERE d.id = ?
        ");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function updateStatut(string $id, string $statut, string $traitePar): bool {
        $stmt = $this->db->prepare("
            UPDATE demandes 
            SET statut = ?, traite_par = ?, date_traitement = NOW() 
            WHERE id = ?
        ");
        return $stmt->execute([$statut, $traitePar, $id]);
    }

    public function updateInscriptionStatut(string $inscriptionId, string $statut): bool {
        $stmt = $this->db->prepare("UPDATE inscriptions SET statut = ? WHERE id = ?");
        return $stmt->execute([$statut, $inscriptionId]);
    }
}
?>