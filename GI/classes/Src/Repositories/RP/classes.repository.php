<?php
require_once __DIR__ . '/../../../../config/database.php';
require_once __DIR__ . '/../../Models/RP/classes.model.php';

class ClassesRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM classes ORDER BY created_at DESC");
        $classes = [];
        
        while ($row = $stmt->fetch()) {
            $classes[] = new ClasseModel(
                $row['id'],
                $row['libelle'],
                $row['filiere'],
                $row['niveau'],
                $row['created_at']
            );
        }
        
        return $classes;
    }

    public function getById(string $id): ?ClasseModel {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        
        if ($row) {
            return new ClasseModel(
                $row['id'],
                $row['libelle'],
                $row['filiere'],
                $row['niveau'],
                $row['created_at']
            );
        }
        
        return null;
    }

    public function create(ClasseModel $classe): bool {
        $stmt = $this->db->prepare("INSERT INTO classes (id, libelle, filiere, niveau) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $classe->getId(),
            $classe->getLibelle(),
            $classe->getFiliere(),
            $classe->getNiveau()
        ]);
    }

    public function update(ClasseModel $classe): bool {
        $stmt = $this->db->prepare("UPDATE classes SET libelle = ?, filiere = ?, niveau = ? WHERE id = ?");
        return $stmt->execute([
            $classe->getLibelle(),
            $classe->getFiliere(),
            $classe->getNiveau(),
            $classe->getId()
        ]);
    }

    public function delete(string $id): bool {
        $stmt = $this->db->prepare("DELETE FROM classes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getModulesCount(string $classeId): int {
        $stmt = $this->db->prepare("
            SELECT COUNT(DISTINCT pm.module_id) as count
            FROM prof_classes pc
            JOIN prof_modules pm ON pc.professeur_id = pm.professeur_id
            WHERE pc.classe_id = ?
        ");
        $stmt->execute([$classeId]);
        $result = $stmt->fetch();
        return $result['count'] ?? 0;
    }

    public function getProfesseursCount(string $classeId): int {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM prof_classes WHERE classe_id = ?");
        $stmt->execute([$classeId]);
        $result = $stmt->fetch();
        return $result['count'] ?? 0;
    }
}
?>