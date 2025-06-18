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
            require_once '../../Controllers/RP/header.controller.php';

            $headerController = new HeaderController();
            $headerController->afficherHeader();
        ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <h2 class="text-xl mb-4">Statistiques</h2>
            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-300">Année scolaire :</label>
                <select id="year" class="mt-1 block w-40 bg-gray-700 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option>2023-2024</option>
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Effectif Total -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">Effectif total</h3>
                    <p class="text-4xl font-bold">4</p>
                    <p class="text-gray-400">étudiants inscrits</p>
                    <div class="flex space-x-2 mt-2">
                        <span class="flex items-center"><span class="w-3 h-3 bg-blue-500 rounded-full mr-1"></span> 2 garçons</span>
                        <span class="flex items-center"><span class="w-3 h-3 bg-pink-500 rounded-full mr-1"></span> 2 filles</span>
                    </div>
                </div>
                <!-- Inscriptions Suspendues/Annulées -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">Inscriptions suspendues/annulées</h3>
                    <p class="text-4xl font-bold">1</p>
                    <p class="text-gray-400">étudiants concernés</p>
                </div>
            </div>
            <div class="mt-4 bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Répartition par sexe</h3>
                <!-- Placeholder for Pie Chart -->
                <div class="h-64 flex items-center justify-center text-gray-400">Graphique circulaire ici (ex. Chart.js)</div>
                <div class="flex space-x-2 mt-2">
                    <span class="flex items-center"><span class="w-3 h-3 bg-blue-500 rounded-full mr-1"></span> Garçons</span>
                    <span class="flex items-center"><span class="w-3 h-3 bg-pink-500 rounded-full mr-1"></span> Filles</span>
                </div>
            </div>
            <div class="mt-4 bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Effectif par classe</h3>
                <!-- Placeholder for Bar Chart -->
                <div class="h-64 flex items-center justify-center text-gray-400">Graphique en barres ici (ex. Chart.js)</div>
                <div class="flex space-x-2 mt-2">
                    <span class="flex items-center"><span class="w-3 h-3 bg-blue-500 rounded-full mr-1"></span> Garçons</span>
                    <span class="flex items-center"><span class="w-3 h-3 bg-pink-500 rounded-full mr-1"></span> Filles</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>