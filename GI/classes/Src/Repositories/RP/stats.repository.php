<?php
require_once __DIR__ . '/../../../../config/database.php';

class StatsRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getEffectifTotal(string $annee): int {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total 
            FROM inscriptions 
            WHERE annee_scolaire = ? AND statut = 'active'
        ");
        $stmt->execute([$annee]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    public function getRepartitionSexe(string $annee): array {
        $stmt = $this->db->prepare("
            SELECT e.sexe, COUNT(*) as nombre
            FROM inscriptions i
            JOIN etudiants e ON i.etudiant_id = e.id
            WHERE i.annee_scolaire = ? AND i.statut = 'active'
            GROUP BY e.sexe
        ");
        $stmt->execute([$annee]);
        
        $repartition = ['M' => 0, 'F' => 0];
        while ($row = $stmt->fetch()) {
            $repartition[$row['sexe']] = $row['nombre'];
        }
        
        return $repartition;
    }

    public function getInscriptionsSuspenduesTotales(string $annee): int {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total 
            FROM inscriptions 
            WHERE annee_scolaire = ? AND statut = 'suspendue'
        ");
        $stmt->execute([$annee]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    public function getInscriptionsAnnuleesTotales(string $annee): int {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total 
            FROM inscriptions 
            WHERE annee_scolaire = ? AND statut = 'annulee'
        ");
        $stmt->execute([$annee]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    public function getEffectifParClasse(string $annee): array {
        $stmt = $this->db->prepare("
            SELECT c.libelle, c.filiere, c.niveau, COUNT(i.id) as effectif
            FROM classes c
            LEFT JOIN inscriptions i ON c.id = i.classe_id AND i.annee_scolaire = ? AND i.statut = 'active'
            GROUP BY c.id, c.libelle, c.filiere, c.niveau
            ORDER BY c.libelle
        ");
        $stmt->execute([$annee]);
        return $stmt->fetchAll();
    }

    public function getRepartitionSexeParClasse(string $annee): array {
        $stmt = $this->db->prepare("
            SELECT c.libelle, e.sexe, COUNT(*) as nombre
            FROM inscriptions i
            JOIN classes c ON i.classe_id = c.id
            JOIN etudiants e ON i.etudiant_id = e.id
            WHERE i.annee_scolaire = ? AND i.statut = 'active'
            GROUP BY c.id, c.libelle, e.sexe
            ORDER BY c.libelle
        ");
        $stmt->execute([$annee]);
        
        $repartition = [];
        while ($row = $stmt->fetch()) {
            if (!isset($repartition[$row['libelle']])) {
                $repartition[$row['libelle']] = ['M' => 0, 'F' => 0];
            }
            $repartition[$row['libelle']][$row['sexe']] = $row['nombre'];
        }
        
        return $repartition;
    }

    public function getAnneesDisponibles(): array {
        $stmt = $this->db->query("
            SELECT DISTINCT annee_scolaire 
            FROM inscriptions 
            ORDER BY annee_scolaire DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>