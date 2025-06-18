<?php
require_once __DIR__ . '/../../Models/RP/header.model.php';
require_once __DIR__ . '/../../Repositories/RP/header.repository.php';
require_once __DIR__ . '/../../Services/RP/header.service.php';

class HeaderController {
    public function afficherHeader(?string $pageActive = null): void {
    $user = new HeaderModel('Responsable Pédagogique');
    $repository = new HeaderRepository();
    $liens = $repository->getLiens();

    if (!$pageActive) {
        $pageFile = basename($_SERVER['PHP_SELF']);
        $pageActive = explode('.', $pageFile)[0];
    }

    $service = new HeaderService($liens);
    $liensAvecActif = $service->ajouterClasseActive($pageActive);

    include __DIR__ . '/../../Views/RP/header.view.php';
}

}
