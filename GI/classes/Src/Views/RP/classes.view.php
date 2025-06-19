<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/RP/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('classes');
        ?>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Gestion des Classes</h2>
                <button 
                    id="addClassBtn" 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                    onclick="document.getElementById('addClassModal').classList.remove('hidden')"
                >+ Ajouter une classe</button>
            </div>

            <!-- Modal -->
            <div id="addClassModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                    <h3 class="text-lg mb-4">Ajouter une nouvelle classe</h3>
                    <form method="post" action="classes.php?action=create">
                        <div class="mb-3">
                            <label class="block mb-1" for="class_id">ID *</label>
                            <input type="text" id="class_id" name="class_id" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="libelle">Libellé *</label>
                            <input type="text" id="libelle" name="libelle" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="filiere">Filière *</label>
                            <input type="text" id="filiere" name="filiere" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="niveau">Niveau *</label>
                            <input type="text" id="niveau" name="niveau" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="document.getElementById('addClassModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Annuler</button>
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
                        <th class="p-2">Modules</th>
                        <th class="p-2">Professeurs</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classes as $classe): ?>
                        <?php 
                            $modulesCount = $this->repository->getModulesCount($classe->getId());
                            $professeursCount = $this->repository->getProfesseursCount($classe->getId());
                        ?>
                        <tr class="border-t border-gray-600">
                            <td class="p-2"><?= htmlspecialchars($classe->getId()) ?></td>
                            <td class="p-2"><?= htmlspecialchars($classe->getLibelle()) ?></td>
                            <td class="p-2"><?= htmlspecialchars($classe->getFiliere()) ?></td>
                            <td class="p-2"><?= htmlspecialchars($classe->getNiveau()) ?></td>
                            <td class="p-2"><?= $modulesCount ?></td>
                            <td class="p-2"><?= $professeursCount ?></td>
                            <td class="p-2">
                                <a href="classes.php?action=details&id=<?= urlencode($classe->getId()) ?>" class="text-blue-400 hover:text-blue-300">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>