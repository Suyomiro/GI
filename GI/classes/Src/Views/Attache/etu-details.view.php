<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Étudiant</title>
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
                <h2 class="text-xl">Détails de l'Étudiant</h2>
                <a href="etu.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Retour</a>
            </div>

            <div class="bg-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Informations Personnelles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="mb-2"><strong>Matricule:</strong> <?= htmlspecialchars($etudiant['matricule']) ?></p>
                        <p class="mb-2"><strong>Nom:</strong> <?= htmlspecialchars($etudiant['nom']) ?></p>
                        <p class="mb-2"><strong>Prénom:</strong> <?= htmlspecialchars($etudiant['prenom']) ?></p>
                    </div>
                    <div>
                        <p class="mb-2"><strong>Sexe:</strong> <?= $etudiant['sexe'] === 'M' ? 'Masculin' : 'Féminin' ?></p>
                        <p class="mb-2"><strong>Adresse:</strong> <?= htmlspecialchars($etudiant['adresse']) ?></p>
                        <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($etudiant['email']) ?></p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="mb-2"><strong>Date de création:</strong> <?= date('d/m/Y H:i', strtotime($etudiant['created_at'])) ?></p>
                </div>
                
                <div class="mt-6 flex space-x-4">
                    <a href="etu.php?action=inscriptions&id=<?= urlencode($etudiant['id']) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Voir les inscriptions</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>