<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/Attache/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('Inscriptions');
        ?>

        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Détails de l'Inscription</h2>
                <a href="inscriptions.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Retour</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informations Étudiant -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3">Informations Étudiant</h3>
                    <div class="space-y-2">
                        <p><strong>Matricule:</strong> <?= htmlspecialchars($inscription['matricule']) ?></p>
                        <p><strong>Nom complet:</strong> <?= htmlspecialchars($inscription['nom'] . ' ' . $inscription['prenom']) ?></p>
                        <p><strong>Sexe:</strong> <?= $inscription['sexe'] === 'M' ? 'Masculin' : 'Féminin' ?></p>
                        <p><strong>Adresse:</strong> <?= htmlspecialchars($inscription['adresse']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($inscription['email']) ?></p>
                    </div>
                </div>

                <!-- Informations Inscription -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3">Informations Inscription</h3>
                    <div class="space-y-2">
                        <p><strong>Classe:</strong> <?= htmlspecialchars($inscription['classe_libelle']) ?></p>
                        <p><strong>Filière:</strong> <?= htmlspecialchars($inscription['filiere']) ?></p>
                        <p><strong>Niveau:</strong> <?= htmlspecialchars($inscription['niveau']) ?></p>
                        <p><strong>Année scolaire:</strong> <?= htmlspecialchars($inscription['annee_scolaire']) ?></p>
                        <p><strong>Date d'inscription:</strong> <?= date('d/m/Y H:i', strtotime($inscription['date_inscription'])) ?></p>
                        <p><strong>Statut:</strong> 
                            <span class="<?= 
                                $inscription['statut'] === 'active' ? 'text-green-500' : 
                                ($inscription['statut'] === 'suspendue' ? 'text-yellow-500' : 'text-red-500') 
                            ?>">
                                <?= ucfirst($inscription['statut']) ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>