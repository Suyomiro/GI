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
            <div class="mb-4">
                <h2 class="text-xl">Gestion des Demandes</h2>
                <p class="text-gray-400">Traitement des demandes d'annulation et de suspension</p>
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">ID</th>
                        <th class="p-2">Étudiant</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Motif</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Statut</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">1</td>
                        <td class="p-2">Sarr Moussa</td>
                        <td class="p-2 text-yellow-500">Suspension</td>
                        <td class="p-2">Raisons de santé</td>
                        <td class="p-2">2023-10-05</td>
                        <td class="p-2 text-green-500">acceptée</td>
                        <td class="p-2">Traitée</td>
                    </tr>
                    <tr class="border-t border-gray-600">
                        <td class="p-2">2</td>
                        <td class="p-2">Fall Ousmane</td>
                        <td class="p-2 text-red-500">Annulation</td>
                        <td class="p-2">Changement d'orientation</td>
                        <td class="p-2">2023-10-10</td>
                        <td class="p-2 text-yellow-500">en attente</td>
                        <td class="p-2 flex space-x-2">
                            <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Accepter</button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Refuser</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>