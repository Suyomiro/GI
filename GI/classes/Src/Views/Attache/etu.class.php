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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Gestion des Étudiants</h2>
                <button class="bg-green-500 text-white px-4 py-2 rounded">+ Ajouter un étudiant</button>
            </div>
            <div class="bg-gray-700 p-2 rounded mb-4 flex justify-end">
                <input type="text" class="w-full md:w-1/3 bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Rechercher un étudiant...">
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Matricule</th>
                        <th class="p-2">Nom complet</th>
                        <th class="p-2">Sexe</th>
                        <th class="p-2">Adresse</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">1</td>
                        <td class="p-2">ET001</td>
                        <td class="p-2">Diallo Mariama</td>
                        <td class="p-2">Féminin</td>
                        <td class="p-2">Dakar, Sacré-Cœur</td>
                        <td class="p-2 flex space-x-2">
                            <button class="text-blue-400">Détails</button>
                            <button class="text-blue-400">Inscriptions</button>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">2</td>
                        <td class="p-2">ET002</td>
                        <td class="p-2">Fall Ousmane</td>
                        <td class="p-2">Masculin</td>
                        <td class="p-2">Dakar, Médina</td>
                        <td class="p-2 flex space-x-2">
                            <button class="text-blue-400">Détails</button>
                            <button class="text-blue-400">Inscriptions</button>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">3</td>
                        <td class="p-2">ET003</td>
                        <td class="p-2">Mbaye Aida</td>
                        <td class="p-2">Féminin</td>
                        <td class="p-2">Dakar, Yoff</td>
                        <td class="p-2 flex space-x-2">
                            <button class="text-blue-400">Détails</button>
                            <button class="text-blue-400">Inscriptions</button>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">4</td>
                        <td class="p-2">ET004</td>
                        <td class="p-2">Sarr Moussa</td>
                        <td class="p-2">Masculin</td>
                        <td class="p-2">Dakar, Ouakam</td>
                        <td class="p-2 flex space-x-2">
                            <button class="text-blue-400">Détails</button>
                            <button class="text-blue-400">Inscriptions</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>