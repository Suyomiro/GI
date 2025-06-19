<?php
require_once __DIR__ . '/../../../../config/database.php';
require_once __DIR__ . '/../../Models/Attache/inscriptions.model.php';

class InscriptionsRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getInscriptions(string $annee = '', string $classe = '', string $recherche = ''): array {
        $sql = "
            SELECT i.*, e.nom, e.prenom, e.matricule, c.libelle as classe_libelle
            FROM inscriptions i
            JOIN etudiants e ON i.etudiant_id = e.id
            JOIN classes c ON i.classe_id = c.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($annee)) {
            $sql .= " AND i.annee_scolaire = ?";
            $params[] = $annee;
        }
        
        if (!empty($classe)) {
            $sql .= " AND i.classe_id = ?";
            $params[] = $classe;
        }
        
        if (!empty($recherche)) {
            $sql .= " AND (e.nom LIKE ? OR e.prenom LIKE ? OR e.matricule LIKE ?)";
            $params[] = "%$recherche%";
            $params[] = "%$recherche%";
            $params[] = "%$recherche%";
        }
        
        $sql .= " ORDER BY i.date_inscription DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById(string $id): ?array {
        $stmt = $this->db->prepare("
            SELECT i.*, e.nom, e.prenom, e.matricule, e.sexe, e.adresse, e.email,
                   c.libelle as classe_libelle, c.filiere, c.niveau
            FROM inscriptions i
            JOIN etudiants e ON i.etudiant_id = e.id
            JOIN classes c ON i.classe_id = c.id
            WHERE i.id = ?
        ");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(InscriptionModel $inscription): bool {
        // Vérifier si l'étudiant n'est pas déjà inscrit cette année
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM inscriptions 
            WHERE etudiant_id = ? AND annee_scolaire = ?
        ");
        $stmt->execute([$inscription->getEtudiantId(), $inscription->getAnneeScolaire()]);
        $result = $stmt->fetch();
        
        if ($result['count'] > 0) {
            return false; // Déjà inscrit cette année
        }

        $stmt = $this->db->prepare("
            INSERT INTO inscriptions (id, etudiant_id, classe_id, annee_scolaire, date_inscription, statut) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $inscription->getId(),
            $inscription->getEtudiantId(),
            $inscription->getClasseId(),
            $inscription->getAnneeScolaire(),
            $inscription->getDateInscription(),
            $inscription->getStatut()
        ]);
    }

    public function getAllClasses(): array {
        $stmt = $this->db->query("SELECT * FROM classes ORDER BY libelle");
        return $stmt->fetchAll();
    }

    public function getAllEtudiants(): array {
        $stmt = $this->db->query("SELECT * FROM etudiants ORDER BY nom, prenom");
        return $stmt->fetchAll();
    }

    public function getAnneesDisponibles(): array {
        $stmt = $this->db->query("
            SELECT DISTINCT annee_scolaire 
            FROM inscriptions 
            ORDER BY annee_scolaire DESC
        ");
        $annees = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Ajouter l'année actuelle si elle n'existe pas
        $anneeActuelle = date('Y') . '-' . (date('Y') + 1);
        if (!in_array($anneeActuelle, $annees)) {
            array_unshift($annees, $anneeActuelle);
        }
        
        return $annees;
    }
}
?>