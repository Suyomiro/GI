<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">ISM - Gestion des Inscriptions</h1>
            <div class="flex items-center">
                <span class="mr-2"><?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?> (ÉTUDIANT)</span>
                <a href="/GI/Public/logout.php" class="text-red-400 hover:text-red-300">Déconnexion</a>
            </div>
        </div>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="mb-4">
                <h2 class="text-xl">Espace Étudiant</h2>
                <p class="text-gray-400">Bienvenue, <?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?></p>
                <p class="text-gray-400">Matricule: <?= htmlspecialchars($etudiant['matricule']) ?></p>
                <p class="text-gray-400">Adresse: <?= htmlspecialchars($etudiant['adresse']) ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Mon inscription actuelle -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-2">Mon inscription actuelle</h3>
                    <?php if ($inscriptionActuelle): ?>
                        <ul class="space-y-2">
                            <li>Classe: <?= htmlspecialchars($inscriptionActuelle['classe_libelle']) ?></li>
                            <li>Filière: <?= htmlspecialchars($inscriptionActuelle['filiere']) ?></li>
                            <li>Niveau: <?= htmlspecialchars($inscriptionActuelle['niveau']) ?></li>
                            <li>Année: <?= htmlspecialchars($inscriptionActuelle['annee_scolaire']) ?></li>
                            <li>Date d'inscription: <?= date('d/m/Y', strtotime($inscriptionActuelle['date_inscription'])) ?></li>
                            <li>Statut: <span class="<?= 
                                $inscriptionActuelle['statut'] === 'active' ? 'text-green-500' : 
                                ($inscriptionActuelle['statut'] === 'suspendue' ? 'text-yellow-500' : 'text-red-500') 
                            ?>"><?= ucfirst($inscriptionActuelle['statut']) ?></span></li>
                        </ul>
                        
                        <?php if ($inscriptionActuelle['statut'] === 'active'): ?>
                            <div class="mt-4">
                                <button class="text-yellow-400 mr-2 hover:text-yellow-300" onclick="openRequestForm('suspension')">Demander une suspension</button>
                                <button class="text-red-400 hover:text-red-300" onclick="openRequestForm('annulation')">Demander une annulation</button>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-gray-400">Aucune inscription active trouvée</p>
                    <?php endif; ?>

                    <!-- Formulaire de demande -->
                    <div id="requestForm" class="hidden mt-4">
                        <form method="post" action="dashboard.php?action=create_demande">
                            <input type="hidden" id="type_demande" name="type_demande" value="">
                            <label class="block text-sm font-medium text-gray-300">Motif de la <span id="requestType"></span></label>
                            <textarea name="motif" required class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Entrez le motif..." rows="3"></textarea>
                            <div class="mt-2 flex space-x-2">
                                <button type="button" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600" onclick="closeRequestForm()">Annuler</button>
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Soumettre la demande</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Mes demandes -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-2">Mes demandes</h3>
                    <div class="space-y-2 max-h-64 overflow-y-auto">
                        <?php if (empty($demandes)): ?>
                            <p class="text-gray-400">Vous n'avez pas de demandes.</p>
                        <?php else: ?>
                            <?php foreach ($demandes as $demande): ?>
                                <div class="flex justify-between items-center p-2 bg-gray-800 rounded">
                                    <div>
                                        <span class="<?= $demande['type_demande'] === 'suspension' ? 'text-yellow-500' : 'text-red-500' ?>">
                                            <?= ucfirst($demande['type_demande']) ?>
                                        </span>
                                        <p class="text-sm text-gray-400">Motif: <?= htmlspecialchars($demande['motif']) ?></p>
                                        <p class="text-sm text-gray-400">Date: <?= date('d/m/Y', strtotime($demande['date_demande'])) ?></p>
                                    </div>
                                    <span class="<?= 
                                        $demande['statut'] === 'acceptee' ? 'text-green-500' : 
                                        ($demande['statut'] === 'refusee' ? 'text-red-500' : 'text-yellow-500') 
                                    ?>">
                                        <?= ucfirst(str_replace('_', ' ', $demande['statut'])) ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Historique de mes inscriptions -->
            <div class="mt-4 bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Historique de mes inscriptions</h3>
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
                        <?php if (empty($historiqueInscriptions)): ?>
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400">Aucune inscription trouvée</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($historiqueInscriptions as $inscription): ?>
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

    <script>
        function openRequestForm(type) {
            const form = document.getElementById('requestForm');
            const requestType = document.getElementById('requestType');
            const typeInput = document.getElementById('type_demande');
            
            requestType.textContent = type;
            typeInput.value = type;
            form.classList.remove('hidden');
        }

        function closeRequestForm() {
            const form = document.getElementById('requestForm');
            form.classList.add('hidden');
            form.querySelector('textarea').value = '';
        }
    </script>
</body>
</html>