<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professeurs du Module</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/RP/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('modules');
        ?>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Professeurs du module: <?= htmlspecialchars($module->getNom()) ?></h2>
                <a href="modules.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Retour</a>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Nom complet</th>
                        <th class="p-2">Grade</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($professeurs)): ?>
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-400">Aucun professeur assigné à ce module</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($professeurs as $professeur): ?>
                            <tr class="border-t border-gray-600">
                                <td class="p-2"><?= htmlspecialchars($professeur['id']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($professeur['nom'] . ' ' . $professeur['prenom']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($professeur['grade']) ?></td>
                                <td class="p-2">
                                    <a href="modules.php?action=remove_professeur&module_id=<?= urlencode($module->getId()) ?>&prof_id=<?= urlencode($professeur['id']) ?>" 
                                       class="text-red-400 hover:text-red-300"
                                       onclick="return confirm('Êtes-vous sûr de vouloir retirer ce professeur du module ?')">Retirer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>