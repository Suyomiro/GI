<?php
// Gère la logique métier : définir quel lien est actif.
class HeaderService {
    private array $liens;

    public function __construct(array $liens) {
        $this->liens = $liens;
    }

    public function ajouterClasseActive(string $pageActive): array {
        $liensModifies = [];

        foreach ($this->liens as $cle => $url) {
            $liensModifies[$cle] = [
                'url' => $url,
                'actif' => ($cle === $pageActive)
            ];
        }

        return $liensModifies;
    }
}
