<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Modules</title>
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

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Gestion des Modules</h2>
                <button 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" 
                    onclick="document.getElementById('addModuleModal').classList.remove('hidden')"
                >+ Ajouter un module</button>
            </div>

            <!-- Modal -->
            <div id="addModuleModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                    <h3 class="text-lg mb-4">Ajouter un nouveau module</h3>
                    <form method="post" action="modules.php?action=create">
                        <div class="mb-3">
                            <label class="block mb-1" for="module_id">ID *</label>
                            <input type="text" id="module_id" name="module_id" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="document.getElementById('addModuleModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 rounded text-white hover:bg-green-600">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Nom du module</th>
                        <th class="p-2">Professeurs</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): ?>
                        <?php 
                            $professeursCount = $this->repository->getProfesseursCount($module->getId());
                        ?>
                        <tr class="border-t border-gray-600">
                            <td class="p-2"><?= htmlspecialchars($module->getId()) ?></td>
                            <td class="p-2"><?= htmlspecialchars($module->getNom()) ?></td>
                            <td class="p-2"><?= $professeursCount ?></td>
                            <td class="p-2">
                                <a href="modules.php?action=professeurs&id=<?= urlencode($module->getId()) ?>" class="text-blue-400 hover:text-blue-300">Voir professeurs</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>