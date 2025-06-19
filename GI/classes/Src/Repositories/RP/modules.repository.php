<?php
require_once __DIR__ . '/../../../../config/database.php';
require_once __DIR__ . '/../../Models/RP/modules.model.php';

class ModulesRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM modules ORDER BY nom");
        $modules = [];
        
        while ($row = $stmt->fetch()) {
            $modules[] = new ModuleModel(
                $row['id'],
                $row['nom'],
                $row['created_at']
            );
        }
        
        return $modules;
    }

    public function getById(string $id): ?ModuleModel {
        $stmt = $this->db->prepare("SELECT * FROM modules WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        
        if ($row) {
            return new ModuleModel(
                $row['id'],
                $row['nom'],
                $row['created_at']
            );
        }
        
        return null;
    }

    public function create(ModuleModel $module): bool {
        $stmt = $this->db->prepare("INSERT INTO modules (id, nom) VALUES (?, ?)");
        return $stmt->execute([
            $module->getId(),
            $module->getNom()
        ]);
    }

    public function getProfesseursCount(string $moduleId): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM prof_modules WHERE module_id = ?");
        $stmt->execute([$moduleId]);
        $result = $stmt->fetch();
        return $result['count'] ?? 0;
    }

    public function getProfesseurs(string $moduleId): array {
        $stmt = $this->db->prepare("
            SELECT p.* FROM professeurs p
            JOIN prof_modules pm ON p.id = pm.professeur_id
            WHERE pm.module_id = ?
        ");
        $stmt->execute([$moduleId]);
        return $stmt->fetchAll();
    }

    public function removeProfesseur(string $moduleId, string $profId): bool {
        $stmt = $this->db->prepare("DELETE FROM prof_modules WHERE module_id = ? AND professeur_id = ?");
        return $stmt->execute([$moduleId, $profId]);
    }
}
?>