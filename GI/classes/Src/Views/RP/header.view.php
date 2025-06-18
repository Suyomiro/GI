<?php
// $user => instance de HeaderModel
// $liensAvecActif => tableau des liens avec état actif

?>
<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Gestion des Inscriptions</h1>
    <div class="flex items-center">
        <span class="mr-2"><?= htmlspecialchars($user->getRole()) ?></span>
        <button class="text-red-400">Déconnexion</button>
    </div>
</div>

<!-- Navigation -->
<nav class="mb-6 bg-gray-800 p-2 rounded-lg flex space-x-4">
    <?php foreach ($liensAvecActif as $nom => $data): ?>
        <a href="<?= htmlspecialchars($data['url']) ?>"
           class="bg-gray-700 p-2 rounded-lg <?= $data['actif'] ? 'border-2 border-gray-600' : '' ?>">
            <?= ucfirst($nom) ?>
        </a>
    <?php endforeach; ?>
</nav>
