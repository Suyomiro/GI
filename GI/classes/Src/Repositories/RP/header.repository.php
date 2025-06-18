<?php
// Fournit les liens de navigation du header.
// Peut évoluer si les liens viennent de la base de données plus tard.
class HeaderRepository {
    public function getLiens(): array {
        return [
            'classes' => 'classes.class.php',
            'proffesseurs' => 'prof.class.php',
            'modules' => 'modules.class.php',
            'demandes' => 'demandes.class.php',
            'statistiques' => 'stats.class.php',
        ];
    }
}
