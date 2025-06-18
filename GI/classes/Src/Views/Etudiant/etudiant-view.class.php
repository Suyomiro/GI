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
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">ISM - Gestion des Inscriptions</h1>
            <div class="flex items-center">
                <span class="mr-2">Diallo Mariama (ÉTUDIANT)</span>
                <button class="text-red-400" id="logout">Déconnexion</button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="mb-4">
                <h2 class="text-xl">Espace Étudiant</h2>
                <p class="text-gray-400">Bienvenue, Diallo Mariama</p>
                <p class="text-gray-400">Matricule: ET001</p>
                <p class="text-gray-400">Adresse: Dakar, Sacré-Cœur</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Mon inscription actuelle -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-2">Mon inscription actuelle</h3>
                    <ul class="space-y-2">
                        <li>Classe: Classe A</li>
                        <li>Filière: Informatique</li>
                        <li>Niveau: Licence 1</li>
                        <li>Année: 2023-2024</li>
                        <li>Date d'inscription: 2023-09-15</li>
                    </ul>
                    <div class="mt-2">
                        <button class="text-blue-400 mr-2" onclick="openRequestForm('suspension')">Demander une suspension</button>
                        <button class="text-red-400" onclick="openRequestForm('annulation')">Demander une annulation</button>
                    </div>
                    <div id="requestForm" class="hidden mt-4">
                        <label class="block text-sm font-medium text-gray-300">Motif de la <span id="requestType"></span></label>
                        <input type="text" id="motif" class="mt-1 block w-full bg-gray-800 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Entrez le motif...">
                        <div class="mt-2 flex space-x-2">
                            <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="closeRequestForm()">Annuler</button>
                            <button class="bg-green-500 text-white px-2 py-1 rounded" onclick="submitRequest()">Soumettre la demande</button>
                        </div>
                    </div>
                </div>
                <!-- Mes demandes -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-2">Mes demandes</h3>
                    <div id="demandsList" class="space-y-2">
                        <p class="text-gray-400">Vous n'avez pas de demandes.</p>
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
                            <th class="p-2">Date</th>
                            <th class="p-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody id="inscriptionHistory">
                        <tr class="border-t border-gray-600">
                            <td class="p-2">2023-2024</td>
                            <td class="p-2">Classe A (Informatique, Licence 1)</td>
                            <td class="p-2">2023-09-15</td>
                            <td class="p-2 text-green-500">active</td>
                        </tr>
                        <tr class="border-t border-gray-600">
                            <td class="p-2">2022-2023</td>
                            <td class="p-2">Classe B (Gestion, Licence 2)</td>
                            <td class="p-2">2022-09-10</td>
                            <td class="p-2 text-red-500">terminée</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let demands = [];

        function openRequestForm(type) {
            const form = document.getElementById('requestForm');
            const requestType = document.getElementById('requestType');
            requestType.textContent = type;
            form.classList.remove('hidden');
        }

        function closeRequestForm() {
            const form = document.getElementById('requestForm');
            form.classList.add('hidden');
            document.getElementById('motif').value = '';
        }

        function submitRequest() {
            const motif = document.getElementById('motif').value;
            const requestType = document.getElementById('requestType').textContent;
            if (motif) {
                const demand = {
                    type: requestType,
                    motif: motif,
                    date: new Date().toISOString().split('T')[0],
                    status: 'en attente'
                };
                demands.push(demand);
                updateDemandsList();
                closeRequestForm();
                alert('Demande créée avec succès');
            } else {
                alert('Veuillez entrer un motif.');
            }
        }

        function updateDemandsList() {
            const demandsList = document.getElementById('demandsList');
            demandsList.innerHTML = '';
            if (demands.length === 0) {
                demandsList.innerHTML = '<p class="text-gray-400">Vous n\'avez pas de demandes.</p>';
            } else {
                demands.forEach(demand => {
                    const div = document.createElement('div');
                    div.className = 'flex justify-between items-center p-2 bg-gray-800 rounded';
                    div.innerHTML = `
                        <span class="${demand.type === 'suspension' ? 'text-yellow-500' : 'text-red-500'}">${demand.type}</span>
                        <span>Motif: ${demand.motif}</span>
                        <span>Date: ${demand.date}</span>
                        <span class="text-yellow-500">${demand.status}</span>
                    `;
                    demandsList.appendChild(div);
                });
            }
        }

        // Logout functionality (example)
        document.getElementById('logout').addEventListener('click', () => {
            alert('Déconnexion en cours...');
            // Add logout logic here
        });
    </script>
</body>
</html>