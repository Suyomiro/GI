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
                <h2 class="text-xl">Gestion des Inscriptions</h2>
                <button class="bg-green-500 text-white px-4 py-2 rounded">+ Nouvelle inscription</button>
            </div>
            <div class="bg-gray-700 p-2 rounded mb-4 flex space-x-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300">Année scolaire</label>
                    <select class="mt-1 block w-40 bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option>2023-2024</option>
                        <option>2022-2023</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300">Classe</label>
                    <select class="mt-1 block w-40 bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option>Toutes les classes</option>
                        <option>Classe A</option>
                        <option>Classe B</option>
                        <option>Classe C</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-300">Recherche</label>
                    <input type="text" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nom ou matricule...">
                </div>
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Étudiant</th>
                        <th class="p-2">Matricule</th>
                        <th class="p-2">Classe</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Statut</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">1</td>
                        <td class="p-2">Diallo Mariama</td>
                        <td class="p-2">ET001</td>
                        <td class="p-2">Classe A</td>
                        <td class="p-2">2023-09-15</td>
                        <td class="p-2 text-green-500">active</td>
                        <td class="p-2"><button class="text-blue-400">Détails</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">2</td>
                        <td class="p-2">Fall Ousmane</td>
                        <td class="p-2">ET002</td>
                        <td class="p-2">Classe A</td>
                        <td class="p-2">2023-09-16</td>
                        <td class="p-2 text-green-500">active</td>
                        <td class="p-2"><button class="text-blue-400">Détails</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">3</td>
                        <td class="p-2">Mbaye Aida</td>
                        <td class="p-2">ET003</td>
                        <td class="p-2">Classe B</td>
                        <td class="p-2">2023-09-14</td>
                        <td class="p-2 text-green-500">active</td>
                        <td class="p-2"><button class="text-blue-400">Détails</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">4</td>
                        <td class="p-2">Sarr Moussa</td>
                        <td class="p-2">ET004</td>
                        <td class="p-2">Classe C</td>
                        <td class="p-2">2023-09-17</td>
                        <td class="p-2 text-yellow-500">suspendu</td>
                        <td class="p-2"><button class="text-blue-400">Détails</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>