<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/RP/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('statistiques');
        ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl">Statistiques</h2>
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-300">Année scolaire :</label>
                    <select id="year" class="mt-1 block w-40 bg-gray-700 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" onchange="changerAnnee()">
                        <?php foreach ($anneesDisponibles as $anneeDisponible): ?>
                            <option value="<?= htmlspecialchars($anneeDisponible) ?>" <?= $anneeDisponible === $annee ? 'selected' : '' ?>>
                                <?= htmlspecialchars($anneeDisponible) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Effectif Total -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">Effectif total</h3>
                    <p class="text-4xl font-bold text-blue-400"><?= $stats->getEffectifTotal() ?></p>
                    <p class="text-gray-400">étudiants inscrits</p>
                </div>

                <!-- Garçons -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">Garçons</h3>
                    <p class="text-4xl font-bold text-blue-500"><?= $stats->getNombreGarcons() ?></p>
                    <p class="text-gray-400">étudiants masculins</p>
                </div>

                <!-- Filles -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">Filles</h3>
                    <p class="text-4xl font-bold text-pink-500"><?= $stats->getNombreFilles() ?></p>
                    <p class="text-gray-400">étudiantes féminines</p>
                </div>

                <!-- Suspensions/Annulations -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold">Suspensions/Annulations</h3>
                    <p class="text-4xl font-bold text-red-400"><?= $stats->getInscriptionsSuspendues() + $stats->getInscriptionsAnnulees() ?></p>
                    <p class="text-gray-400">inscriptions concernées</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Répartition par sexe -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Répartition par sexe</h3>
                    <div class="relative h-64">
                        <canvas id="sexeChart"></canvas>
                    </div>
                </div>

                <!-- Effectif par classe -->
                <div class="bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Effectif par classe</h3>
                    <div class="relative h-64">
                        <canvas id="classeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tableau détaillé -->
            <div class="mt-6 bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Détail par classe</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-600">
                            <th class="p-2">Classe</th>
                            <th class="p-2">Filière</th>
                            <th class="p-2">Niveau</th>
                            <th class="p-2">Effectif Total</th>
                            <th class="p-2">Garçons</th>
                            <th class="p-2">Filles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stats->getEffectifParClasse() as $classe): ?>
                            <?php 
                                $repartitionClasse = $stats->getRepartitionSexeParClasse()[$classe['libelle']] ?? ['M' => 0, 'F' => 0];
                            ?>
                            <tr class="border-t border-gray-600">
                                <td class="p-2"><?= htmlspecialchars($classe['libelle']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($classe['filiere']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($classe['niveau']) ?></td>
                                <td class="p-2 font-bold"><?= $classe['effectif'] ?></td>
                                <td class="p-2 text-blue-400"><?= $repartitionClasse['M'] ?></td>
                                <td class="p-2 text-pink-400"><?= $repartitionClasse['F'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Données pour les graphiques
        const statsData = <?= json_encode($stats->toArray()) ?>;

        // Graphique répartition par sexe
        const sexeCtx = document.getElementById('sexeChart').getContext('2d');
        new Chart(sexeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Garçons', 'Filles'],
                datasets: [{
                    data: [statsData.nombreGarcons, statsData.nombreFilles],
                    backgroundColor: ['#3B82F6', '#EC4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#E5E7EB'
                        }
                    }
                }
            }
        });

        // Graphique effectif par classe
        const classeCtx = document.getElementById('classeChart').getContext('2d');
        const classeLabels = statsData.effectifParClasse.map(c => c.libelle);
        const classeEffectifs = statsData.effectifParClasse.map(c => c.effectif);

        new Chart(classeCtx, {
            type: 'bar',
            data: {
                labels: classeLabels,
                datasets: [{
                    label: 'Effectif',
                    data: classeEffectifs,
                    backgroundColor: '#10B981',
                    borderColor: '#059669',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#E5E7EB'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#E5E7EB'
                        },
                        grid: {
                            color: '#374151'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#E5E7EB'
                        },
                        grid: {
                            color: '#374151'
                        }
                    }
                }
            }
        });

        function changerAnnee() {
            const annee = document.getElementById('year').value;
            window.location.href = `stats.php?annee=${annee}`;
        }
    </script>
</body>
</html>