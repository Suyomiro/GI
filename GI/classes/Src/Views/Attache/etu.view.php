<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/Attache/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('Étudiants');
        ?>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Gestion des Étudiants</h2>
                <button 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                    onclick="document.getElementById('addEtudiantModal').classList.remove('hidden')"
                >+ Ajouter un étudiant</button>
            </div>

            <!-- Filtres -->
            <form method="GET" class="bg-gray-700 p-4 rounded mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Sexe</label>
                        <select name="sexe" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Tous</option>
                            <option value="M" <?= ($_GET['sexe'] ?? '') === 'M' ? 'selected' : '' ?>>Masculin</option>
                            <option value="F" <?= ($_GET['sexe'] ?? '') === 'F' ? 'selected' : '' ?>>Féminin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Recherche</label>
                        <input type="text" name="recherche" value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nom, prénom, matricule...">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Rechercher</button>
                    </div>
                </div>
            </form>

            <!-- Modal Ajouter Étudiant -->
            <div id="addEtudiantModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                    <h3 class="text-lg mb-4">Ajouter un nouvel étudiant</h3>
                    <form method="post" action="etu.php?action=create">
                        <div class="mb-3">
                            <label class="block mb-1" for="matricule">Matricule *</label>
                            <input type="text" id="matricule" name="matricule" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="prenom">Prénom *</label>
                            <input type="text" id="prenom" name="prenom" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="sexe">Sexe *</label>
                            <select id="sexe" name="sexe" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                                <option value="">Sélectionner</option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="adresse">Adresse *</label>
                            <input type="text" id="adresse" name="adresse" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="email">Email *</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="document.getElementById('addEtudiantModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 rounded text-white hover:bg-green-600">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tableau des étudiants -->
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">Matricule</th>
                        <th class="p-2">Nom complet</th>
                        <th class="p-2">Sexe</th>
                        <th class="p-2">Adresse</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($etudiants)): ?>
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-400">Aucun étudiant trouvé</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($etudiants as $etudiant): ?>
                            <tr class="border-t border-gray-600">
                                <td class="p-2"><?= htmlspecialchars($etudiant['matricule']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?></td>
                                <td class="p-2"><?= $etudiant['sexe'] === 'M' ? 'Masculin' : 'Féminin' ?></td>
                                <td class="p-2"><?= htmlspecialchars($etudiant['adresse']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($etudiant['email']) ?></td>
                                <td class="p-2 flex space-x-2">
                                    <a href="etu.php?action=details&id=<?= urlencode($etudiant['id']) ?>" class="text-blue-400 hover:text-blue-300">Détails</a>
                                    <a href="etu.php?action=inscriptions&id=<?= urlencode($etudiant['id']) ?>" class="text-green-400 hover:text-green-300">Inscriptions</a>
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