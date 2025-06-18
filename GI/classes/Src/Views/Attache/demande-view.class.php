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
            $headerController->afficherHeader();
        ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <h2 class="text-xl mb-4">Suivi des Demandes</h2>
            <p class="text-gray-400 mb-4">Recherchez les demandes par matricule d’étudiant</p>
            <div class="bg-gray-700 p-2 rounded mb-4 flex items-center space-x-2">
                <input type="text" class="flex-1 bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Entrez un matricule...">
                <button class="bg-green-500 text-white px-4 py-2 rounded">Rechercher</button>
            </div>
            <p class="text-gray-400 mb-4">Entrez un matricule pour afficher les demandes</p>
        </div>
    </div>
</body>
</html>