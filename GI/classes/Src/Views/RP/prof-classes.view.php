<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes du Professeur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/RP/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('proffesseurs');
        ?>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Classes de <?= htmlspecialchars($professeur->getNomComplet()) ?></h2>
                <div class="space-x-2">
                    <button 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                        onclick="document.getElementById('addClasseModal').classList.remove('hidden')"
                    >+ Ajouter une classe</button>
                    <a href="prof.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Retour</a>
                </div>
            </div>

            <!-- Modal Ajouter Classe -->
            <div id="addClasseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                    <h3 class="text-lg mb-4">Ajouter une classe</h3>
                    <form method="post" action="prof.php?action=add_classe">
                        <input type="hidden" name="prof_id" value="<?= htmlspecialchars($professeur->getId()) ?>">
                        <div class="mb-3">
                            <label class="block mb-1" for="classe_id">Classe *</label>
                            <select id="classe_id" name="classe_id" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                                <option value="">Sélectionner une classe</option>
                                <?php foreach ($allClasses as $classe): ?>
                                    <option value="<?= htmlspecialchars($classe->getId()) ?>">
                                        <?= htmlspecialchars($classe->getLibelle()) ?> - <?= htmlspecialchars($classe->getFiliere()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="document.getElementById('addClasseModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 rounded text-white hover:bg-green-600">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Libellé</th>
                        <th class="p-2">Filière</th>
                        <th class="p-2">Niveau</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($classes)): ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">Aucune classe assignée</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($classes as $classe): ?>
                            <tr class="border-t border-gray-600">
                                <td class="p-2"><?= htmlspecialchars($classe['id']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($classe['libelle']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($classe['filiere']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($classe['niveau']) ?></td>
                                <td class="p-2">
                                    <a href="prof.php?action=remove_classe&prof_id=<?= urlencode($professeur->getId()) ?>&classe_id=<?= urlencode($classe['id']) ?>" 
                                       class="text-red-400 hover:text-red-300"
                                       onclick="return confirm('Êtes-vous sûr de vouloir retirer cette classe ?')">Retirer</a>
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