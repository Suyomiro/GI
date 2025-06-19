<?php
require_once __DIR__ . '/../../../../config/database.php';

class DemandeAttaRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getDemandesByMatricule(string $matricule): array {
        $stmt = $this->db->prepare("
            SELECT d.*, e.nom, e.prenom, e.matricule, 
                   i.annee_scolaire, c.libelle as classe_libelle,
                   u.nom as traite_par_nom, u.prenom as traite_par_prenom
            FROM demandes d
            JOIN etudiants e ON d.etudiant_id = e.id
            JOIN inscriptions i ON d.inscription_id = i.id
            JOIN classes c ON i.classe_id = c.id
            LEFT JOIN users u ON d.traite_par = u.id
            WHERE e.matricule = ?
            ORDER BY d.date_demande DESC
        ");
        $stmt->execute([$matricule]);
        return $stmt->fetchAll();
    }
}
?>