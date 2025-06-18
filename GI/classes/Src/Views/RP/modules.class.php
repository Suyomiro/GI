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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Gestion des Modules</h2>
                <button class="bg-green-500 text-white px-4 py-2 rounded" onclick="document.getElementById('addModuleModal').classList.remove('hidden')">+ Ajouter un module</button>
            </div>
            <!-- Modal -->
                <div id="addModuleModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md">
                        <h3 class="text-lg mb-4">Ajouter un nouveau module</h3>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label class="block mb-1" for="module_id">ID</label>
                                <input type="text" id="module_id" name="module_id" class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                            </div>
                            <div class="mb-3">
                                <label class="block mb-1" for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" class="w-full px-3 py-2 rounded bg-gray-700 text-white">
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="document.getElementById('addModuleModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 rounded">Annuler</button>
                                <button type="submit" class="px-4 py-2 bg-green-500 rounded text-white">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Nom du module</th>
                        <th class="p-2">Professeurs</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">M001</td>
                        <td class="p-2">Programmation Java</td>
                        <td class="p-2">1</td>
                        <td class="p-2"><button class="text-blue-400">Voir professeurs</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">M002</td>
                        <td class="p-2">Comptabilité générale</td>
                        <td class="p-2">1</td>
                        <td class="p-2"><button class="text-blue-400">Voir professeurs</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">M003</td>
                        <td class="p-2">Bases de données</td>
                        <td class="p-2">1</td>
                        <td class="p-2"><button class="text-blue-400">Voir professeurs</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">M004</td>
                        <td class="p-2">Mathématiques</td>
                        <td class="p-2">1</td>
                        <td class="p-2"><button class="text-blue-400">Voir professeurs</button></td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">M005</td>
                        <td class="p-2">Anglais</td>
                        <td class="p-2">1</td>
                        <td class="p-2"><button class="text-blue-400">Voir professeurs</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>