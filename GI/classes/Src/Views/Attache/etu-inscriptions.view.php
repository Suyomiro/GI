<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscriptions de l'Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/Attache/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('Étudiants');
        ?>

        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Inscriptions de <?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?></h2>
                <a href="etu.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Retour</a>
            </div>

            <!-- Informations étudiant -->
            <div class="bg-gray-700 p-4 rounded-lg mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <p><strong>Matricule:</strong> <?= htmlspecialchars($etudiant['matricule']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($etudiant['email']) ?></p>
                    <p><strong>Sexe:</strong> <?= $etudiant['sexe'] === 'M' ? 'Masculin' : 'Féminin' ?></p>
                </div>
            </div>

            <!-- Tableau des inscriptions -->
            <div class="bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Historique des Inscriptions</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-600">
                            <th class="p-2">Année</th>
                            <th class="p-2">Classe</th>
                            <th class="p-2">Filière</th>
                            <th class="p-2">Niveau</th>
                            <th class="p-2">Date</th>
                            <th class="p-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($inscriptions)): ?>
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400">Aucune inscription trouvée</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($inscriptions as $inscription): ?>
                                <tr class="border-t border-gray-600">
                                    <td class="p-2"><?= htmlspecialchars($inscription['annee_scolaire']) ?></td>
                                    <td class="p-2"><?= htmlspecialchars($inscription['classe_libelle']) ?></td>
                                    <td class="p-2"><?= htmlspecialchars($inscription['filiere']) ?></td>
                                    <td class="p-2"><?= htmlspecialchars($inscription['niveau']) ?></td>
                                    <td class="p-2"><?= date('d/m/Y', strtotime($inscription['date_inscription'])) ?></td>
                                    <td class="p-2">
                                        <span class="<?= 
                                            $inscription['statut'] === 'active' ? 'text-green-500' : 
                                            ($inscription['statut'] === 'suspendue' ? 'text-yellow-500' : 'text-red-500') 
                                        ?>">
                                            <?= ucfirst($inscription['statut']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>