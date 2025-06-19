<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Demandes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/Attache/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('Demandes');
        ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <h2 class="text-xl mb-4">Suivi des Demandes</h2>
            <p class="text-gray-400 mb-4">Recherchez les demandes par matricule d'étudiant</p>
            
            <!-- Formulaire de recherche -->
            <form method="GET" class="bg-gray-700 p-4 rounded mb-4">
                <div class="flex items-center space-x-2">
                    <input type="text" name="matricule" value="<?= htmlspecialchars($_GET['matricule'] ?? '') ?>" class="flex-1 bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Entrez un matricule...">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Rechercher</button>
                </div>
            </form>

            <?php if (!empty($_GET['matricule'])): ?>
                <?php if (empty($demandes)): ?>
                    <div class="bg-gray-700 p-4 rounded">
                        <p class="text-gray-400">Aucune demande trouvée pour le matricule "<?= htmlspecialchars($_GET['matricule']) ?>"</p>
                    </div>
                <?php else: ?>
                    <!-- Tableau des demandes -->
                    <div class="bg-gray-700 p-4 rounded">
                        <h3 class="text-lg font-semibold mb-4">Demandes pour <?= htmlspecialchars($demandes[0]['nom'] . ' ' . $demandes[0]['prenom']) ?> (<?= htmlspecialchars($demandes[0]['matricule']) ?>)</h3>
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-600">
                                    <th class="p-2">Type</th>
                                    <th class="p-2">Motif</th>
                                    <th class="p-2">Classe</th>
                                    <th class="p-2">Année</th>
                                    <th class="p-2">Date demande</th>
                                    <th class="p-2">Statut</th>
                                    <th class="p-2">Traité par</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($demandes as $demande): ?>
                                    <tr class="border-t border-gray-600">
                                        <td class="p-2">
                                            <span class="<?= $demande['type_demande'] === 'suspension' ? 'text-yellow-500' : 'text-red-500' ?>">
                                                <?= ucfirst($demande['type_demande']) ?>
                                            </span>
                                        </td>
                                        <td class="p-2"><?= htmlspecialchars($demande['motif']) ?></td>
                                        <td class="p-2"><?= htmlspecialchars($demande['classe_libelle']) ?></td>
                                        <td class="p-2"><?= htmlspecialchars($demande['annee_scolaire']) ?></td>
                                        <td class="p-2"><?= date('d/m/Y', strtotime($demande['date_demande'])) ?></td>
                                        <td class="p-2">
                                            <span class="<?= 
                                                $demande['statut'] === 'acceptee' ? 'text-green-500' : 
                                                ($demande['statut'] === 'refusee' ? 'text-red-500' : 'text-yellow-500') 
                                            ?>">
                                                <?= ucfirst(str_replace('_', ' ', $demande['statut'])) ?>
                                            </span>
                                        </td>
                                        <td class="p-2">
                                            <?php if ($demande['traite_par_nom']): ?>
                                                <?= htmlspecialchars($demande['traite_par_nom'] . ' ' . $demande['traite_par_prenom']) ?>
                                            <?php else: ?>
                                                <span class="text-gray-400">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="bg-gray-700 p-4 rounded">
                    <p class="text-gray-400">Entrez un matricule pour afficher les demandes</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>