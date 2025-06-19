<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Classe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/RP/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('classes');
        ?>

        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Détails de la Classe: <?= htmlspecialchars($classe->getLibelle()) ?></h2>
                <a href="classes.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">← Retour</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informations de la classe -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3">Informations</h3>
                    <div class="space-y-2">
                        <p><strong>ID:</strong> <?= htmlspecialchars($classe->getId()) ?></p>
                        <p><strong>Libellé:</strong> <?= htmlspecialchars($classe->getLibelle()) ?></p>
                        <p><strong>Filière:</strong> <?= htmlspecialchars($classe->getFiliere()) ?></p>
                        <p><strong>Niveau:</strong> <?= htmlspecialchars($classe->getNiveau()) ?></p>
                        <p><strong>Date de création:</strong> <?= date('d/m/Y H:i', strtotime($classe->getCreatedAt())) ?></p>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3">Statistiques</h3>
                    <div class="space-y-2">
                        <p><strong>Nombre de modules:</strong> <?= $modulesCount ?></p>
                        <p><strong>Nombre de professeurs:</strong> <?= $professeursCount ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>