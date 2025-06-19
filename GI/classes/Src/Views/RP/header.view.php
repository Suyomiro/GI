<?php
// $userModel => instance de HeaderModel
// $liensAvecActif => tableau des liens avec état actif
?>
<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Gestion des Inscriptions</h1>
    <div class="flex items-center">
        <span class="mr-2"><?= htmlspecialchars($userModel->getRole()) ?></span>
        <a href="/GI/Public/logout.php" class="text-red-400 hover:text-red-300">Déconnexion</a>
    </div>
</div>

<!-- Navigation -->
<nav class="mb-6 bg-gray-800 p-2 rounded-lg flex space-x-4">
    <?php foreach ($liensAvecActif as $nom => $data): ?>
        <a href="<?= htmlspecialchars($data['url']) ?>"
           class="bg-gray-700 p-2 rounded-lg hover:bg-gray-600 <?= $data['actif'] ? 'border-2 border-gray-600' : '' ?>">
            <?= ucfirst($nom) ?>
        </a>
    <?php endforeach; ?>
</nav>