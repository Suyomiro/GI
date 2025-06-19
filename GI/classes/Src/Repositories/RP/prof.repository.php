<?php
require_once __DIR__ . '/../../../../config/database.php';
require_once __DIR__ . '/../../Models/RP/prof.model.php';

class ProfesseurRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM professeurs ORDER BY nom, prenom");
        $professeurs = [];
        
        while ($row = $stmt->fetch()) {
            $professeurs[] = new ProfesseurModel(
                $row['id'],
                $row['nom'],
                $row['prenom'],
                $row['grade'],
                $row['created_at']
            );
        }
        
        return $professeurs;
    }

    public function getById(string $id): ?ProfesseurModel {
        $stmt = $this->db->prepare("SELECT * FROM professeurs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        
        if ($row) {
            return new ProfesseurModel(
                $row['id'],
                $row['nom'],
                $row['prenom'],
                $row['grade'],
                $row['created_at']
            );
        }
        
        return null;
    }

    public function create(ProfesseurModel $professeur): bool {
        $stmt = $this->db->prepare("INSERT INTO professeurs (id, nom, prenom, grade) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $professeur->getId(),
            $professeur->getNom(),
            $professeur->getPrenom(),
            $professeur->getGrade()
        ]);
    }

    public function getModulesCount(string $profId): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM prof_modules WHERE professeur_id = ?");
        $stmt->execute([$profId]);
        $result = $stmt->fetch();
        return $result['count'] ?? 0;
    }

    public function getClassesCount(string $profId): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM prof_classes WHERE professeur_id = ?");
        $stmt->execute([$profId]);
        $result = $stmt->fetch();
        return $result['count'] ?? 0;
    }

    public function getModules(string $profId): array {
        $stmt = $this->db->prepare("
            SELECT m.* FROM modules m
            JOIN prof_modules pm ON m.id = pm.module_id
            WHERE pm.professeur_id = ?
        ");
        $stmt->execute([$profId]);
        return $stmt->fetchAll();
    }

    public function getClasses(string $profId): array {
        $stmt = $this->db->prepare("
            SELECT c.* FROM classes c
            JOIN prof_classes pc ON c.id = pc.classe_id
            WHERE pc.professeur_id = ?
        ");
        $stmt->execute([$profId]);
        return $stmt->fetchAll();
    }

    public function addModule(string $profId, string $moduleId): bool {
        $stmt = $this->db->prepare("INSERT IGNORE INTO prof_modules (professeur_id, module_id) VALUES (?, ?)");
        return $stmt->execute([$profId, $moduleId]);
    }

    public function removeModule(string $profId, string $moduleId): bool {
        $stmt = $this->db->prepare("DELETE FROM prof_modules WHERE professeur_id = ? AND module_id = ?");
        return $stmt->execute([$profId, $moduleId]);
    }

    public function addClasse(string $profId, string $classeId): bool {
        $stmt = $this->db->prepare("INSERT IGNORE INTO prof_classes (professeur_id, classe_id) VALUES (?, ?)");
        return $stmt->execute([$profId, $classeId]);
    }

    public function removeClasse(string $profId, string $classeId): bool {
        $stmt = $this->db->prepare("DELETE FROM prof_classes WHERE professeur_id = ? AND classe_id = ?");
        return $stmt->execute([$profId, $classeId]);
    }
}
?>