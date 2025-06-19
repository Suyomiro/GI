<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Inscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/Attache/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('Inscriptions');
        ?>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Gestion des Inscriptions</h2>
                <button 
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                    onclick="document.getElementById('addInscriptionModal').classList.remove('hidden')"
                >+ Nouvelle inscription</button>
            </div>

            <!-- Filtres -->
            <form method="GET" class="bg-gray-700 p-4 rounded mb-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Année scolaire</label>
                        <select name="annee" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <?php foreach ($anneesDisponibles as $anneeDisponible): ?>
                                <option value="<?= htmlspecialchars($anneeDisponible) ?>" <?= ($_GET['annee'] ?? '') === $anneeDisponible ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($anneeDisponible) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Classe</label>
                        <select name="classe" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Toutes les classes</option>
                            <?php foreach ($classes as $classeOption): ?>
                                <option value="<?= htmlspecialchars($classeOption['id']) ?>" <?= ($_GET['classe'] ?? '') === $classeOption['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($classeOption['libelle']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300">Recherche</label>
                        <input type="text" name="recherche" value="<?= htmlspecialchars($_GET['recherche'] ?? '') ?>" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nom ou matricule...">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filtrer</button>
                    </div>
                </div>
            </form>

            <!-- Modal Nouvelle Inscription -->
            <div id="addInscriptionModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                    <h3 class="text-lg mb-4">Nouvelle inscription</h3>
                    <form method="post" action="inscriptions.php?action=create">
                        <div class="mb-3">
                            <label class="block mb-1" for="etudiant_id">Étudiant *</label>
                            <select id="etudiant_id" name="etudiant_id" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                                <option value="">Sélectionner un étudiant</option>
                                <?php 
                                $etudiants = $this->service->getAllEtudiants();
                                foreach ($etudiants as $etudiant): ?>
                                    <option value="<?= htmlspecialchars($etudiant['id']) ?>">
                                        <?= htmlspecialchars($etudiant['matricule'] . ' - ' . $etudiant['nom'] . ' ' . $etudiant['prenom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="classe_id">Classe *</label>
                            <select id="classe_id" name="classe_id" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                                <option value="">Sélectionner une classe</option>
                                <?php foreach ($classes as $classe): ?>
                                    <option value="<?= htmlspecialchars($classe['id']) ?>">
                                        <?= htmlspecialchars($classe['libelle'] . ' - ' . $classe['filiere']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block mb-1" for="annee_scolaire">Année scolaire *</label>
                            <select id="annee_scolaire" name="annee_scolaire" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                                <?php foreach ($anneesDisponibles as $anneeDisponible): ?>
                                    <option value="<?= htmlspecialchars($anneeDisponible) ?>">
                                        <?= htmlspecialchars($anneeDisponible) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="document.getElementById('addInscriptionModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-green-500 rounded text-white hover:bg-green-600">Inscrire</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tableau des inscriptions -->
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">Matricule</th>
                        <th class="p-2">Étudiant</th>
                        <th class="p-2">Classe</th>
                        <th class="p-2">Année</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Statut</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inscriptions)): ?>
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-400">Aucune inscription trouvée</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($inscriptions as $inscription): ?>
                            <tr class="border-t border-gray-600">
                                <td class="p-2"><?= htmlspecialchars($inscription['matricule']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($inscription['nom'] . ' ' . $inscription['prenom']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($inscription['classe_libelle']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($inscription['annee_scolaire']) ?></td>
                                <td class="p-2"><?= date('d/m/Y', strtotime($inscription['date_inscription'])) ?></td>
                                <td class="p-2">
                                    <span class="<?= 
                                        $inscription['statut'] === 'active' ? 'text-green-500' : 
                                        ($inscription['statut'] === 'suspendue' ? 'text-yellow-500' : 'text-red-500') 
                                    ?>">
                                        <?= ucfirst($inscription['statut']) ?>
                                    </span>
                                </td>
                                <td class="p-2">
                                    <a href="inscriptions.php?action=details&id=<?= urlencode($inscription['id']) ?>" class="text-blue-400 hover:text-blue-300">Détails</a>
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