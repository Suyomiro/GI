<?php
require_once __DIR__ . '/../../../../config/database.php';
require_once __DIR__ . '/../../Models/Attache/etu.model.php';

class EtuRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getEtudiants(string $sexe = '', string $recherche = ''): array {
        $sql = "SELECT * FROM etudiants WHERE 1=1";
        $params = [];
        
        if (!empty($sexe)) {
            $sql .= " AND sexe = ?";
            $params[] = $sexe;
        }
        
        if (!empty($recherche)) {
            $sql .= " AND (nom LIKE ? OR prenom LIKE ? OR matricule LIKE ? OR email LIKE ?)";
            $params[] = "%$recherche%";
            $params[] = "%$recherche%";
            $params[] = "%$recherche%";
            $params[] = "%$recherche%";
        }
        
        $sql .= " ORDER BY nom, prenom";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById(string $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(EtudiantModel $etudiant): bool {
        // Vérifier si le matricule ou l'email existe déjà
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM etudiants WHERE matricule = ? OR email = ?");
        $stmt->execute([$etudiant->getMatricule(), $etudiant->getEmail()]);
        $result = $stmt->fetch();
        
        if ($result['count'] > 0) {
            return false; // Matricule ou email déjà existant
        }

        // Créer d'abord l'utilisateur
        $stmt = $this->db->prepare("INSERT INTO users (email, password, role, nom, prenom) VALUES (?, ?, 'ETUDIANT', ?, ?)");
        $stmt->execute([$etudiant->getEmail(), 'passer123@', $etudiant->getNom(), $etudiant->getPrenom()]);
        $userId = $this->db->lastInsertId();

        // Créer l'étudiant
        $stmt = $this->db->prepare("
            INSERT INTO etudiants (id, matricule, nom, prenom, sexe, adresse, email, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $etudiant->getId(),
            $etudiant->getMatricule(),
            $etudiant->getNom(),
            $etudiant->getPrenom(),
            $etudiant->getSexe(),
            $etudiant->getAdresse(),
            $etudiant->getEmail(),
            $userId
        ]);
    }

    public function getInscriptions(string $etudiantId): array {
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

    public function getDemandes(string $etudiantId): array {
        $stmt = $this->db->prepare("
            SELECT d.*, i.annee_scolaire, c.libelle as classe_libelle
            FROM demandes d
            JOIN inscriptions i ON d.inscription_id = i.id
            JOIN classes c ON i.classe_id = c.id
            WHERE d.etudiant_id = ?
            ORDER BY d.date_demande DESC
        ");
        $stmt->execute([$etudiantId]);
        return $stmt->fetchAll();
    }
}
?>