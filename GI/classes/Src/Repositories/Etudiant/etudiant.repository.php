<?php
require_once __DIR__ . '/../../../../config/database.php';

class EtudiantRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getEtudiantByUserId(string $userId): ?array {
        $stmt = $this->db->prepare("SELECT * FROM etudiants WHERE user_id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function getInscriptionActuelle(string $etudiantId): ?array {
        $stmt = $this->db->prepare("
            SELECT i.*, c.libelle as classe_libelle, c.filiere, c.niveau
            FROM inscriptions i
            JOIN classes c ON i.classe_id = c.id
            WHERE i.etudiant_id = ? AND i.statut = 'active'
            ORDER BY i.annee_scolaire DESC
            LIMIT 1
        ");
        $stmt->execute([$etudiantId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function getDemandesEtudiant(string $etudiantId): array {
        $stmt = $this->db->prepare("
            SELECT d.*, i.annee_scolaire, c.libelle as classe_libelle,
                   u.nom as traite_par_nom, u.prenom as traite_par_prenom
            FROM demandes d
            JOIN inscriptions i ON d.inscription_id = i.id
            JOIN classes c ON i.classe_id = c.id
            LEFT JOIN users u ON d.traite_par = u.id
            WHERE d.etudiant_id = ?
            ORDER BY d.date_demande DESC
        ");
        $stmt->execute([$etudiantId]);
        return $stmt->fetchAll();
    }

    public function getHistoriqueInscriptions(string $etudiantId): array {
        $stmt = $this->db->prepare("
            SELECT i.*, c.libelle as classe_libelle, c.filiere, c.niveau
            FROM inscriptions i
            JOIN classes c ON i.classe_id = c.id
            WHERE i.etudiant_id = ?
            ORDER BY i.annee_scolaire DESC
        ");
        $stmt->execute([$etudiantId]);
        return $stmt->fetchAll();
    }

    public function createDemande(string $etudiantId, string $inscriptionId, string $typeDemande, string $motif): bool {
        $stmt = $this->db->prepare("
            INSERT INTO demandes (id, etudiant_id, inscription_id, type_demande, motif, date_demande, statut) 
            VALUES (?, ?, ?, ?, ?, NOW(), 'en_attente')
        ");
        return $stmt->execute([
            uniqid('DEM_', true),
            $etudiantId,
            $inscriptionId,
            $typeDemande,
            $motif
        ]);
    }
}
?>