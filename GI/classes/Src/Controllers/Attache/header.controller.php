<?php
require_once __DIR__ . '/../../Models/Attache/header.model.php';
require_once __DIR__ . '/../../Repositories/Attache/header.repository.php';
require_once __DIR__ . '/../../Services/Attache/header.service.php';

class HeaderController {
    public function afficherHeader(?string $pageActive = null): void {
    $user = new HeaderModel('Attaché de Classe (ATTACHÉ)');
    $repository = new HeaderRepository();
    $liens = $repository->getLiens();

    if (!$pageActive) {
        $pageFile = basename($_SERVER['PHP_SELF']);
        $pageActive = explode('.', $pageFile)[0];
    }

    $service = new HeaderService($liens);
    $liensAvecActif = $service->ajouterClasseActive($pageActive);

    include __DIR__ . '/../../Views/Attache/header.view.php';
}

}
