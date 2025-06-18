<?php
// Fournit les liens de navigation du header.
// Peut évoluer si les liens viennent de la base de données plus tard.
class HeaderRepository {
    public function getLiens(): array {
        return [
            'Inscriptions' => 'inscriptions.class.php',
            'Étudiants' => 'etu.class.php',
            'Demandes' => 'demande-view.class.php',
        ];
    }
}
