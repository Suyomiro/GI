<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Demandes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <?php
            require_once __DIR__ . '/../../Controllers/RP/header.controller.php';
            $headerController = new HeaderController();
            $headerController->afficherHeader('demandes');
        ?>

        <?php if (isset($message)): ?>
            <div class="mb-4 p-4 rounded-lg <?= $message['type'] === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
                <?= htmlspecialchars($message['text']) ?>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <div class="mb-4">
                <h2 class="text-xl">Gestion des Demandes</h2>
                <p class="text-gray-400">Traitement des demandes d'annulation et de suspension</p>
            </div>
            
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2">Étudiant</th>
                        <th class="p-2">Matricule</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Motif</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Statut</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($demandes)): ?>
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-400">Aucune demande trouvée</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($demandes as $demande): ?>
                            <tr class="border-t border-gray-600">
                                <td class="p-2"><?= htmlspecialchars($demande['nom'] . ' ' . $demande['prenom']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($demande['matricule']) ?></td>
                                <td class="p-2">
                                    <span class="<?= $demande['type_demande'] === 'suspension' ? 'text-yellow-500' : 'text-red-500' ?>">
                                        <?= ucfirst($demande['type_demande']) ?>
                                    </span>
                                </td>
                                <td class="p-2"><?= htmlspecialchars($demande['motif']) ?></td>
                                <td class="p-2"><?= date('d/m/Y', strtotime($demande['date_demande'])) ?></td>
                                <td class="p-2">
                                    <span class="<?= 
                                        $demande['statut'] === 'acceptee' ? 'text-green-500' : 
                                        ($demande['statut'] === 'refusee' ? 'text-red-500' : 'text-yellow-500') 
                                    ?>">
                                        <?= ucfirst(str_replace('_', ' ', $demande['statut'])) ?>
                                    </span>
                                </td>
                                <td class="p-2">
                                    <?php if ($demande['statut'] === 'en_attente'): ?>
                                        <div class="flex space-x-2">
                                            <form method="post" action="demandes.php?action=traiter" class="inline">
                                                <input type="hidden" name="demande_id" value="<?= htmlspecialchars($demande['id']) ?>">
                                                <input type="hidden" name="action" value="accepter">
                                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 text-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir accepter cette demande ?')">
                                                    Accepter
                                                </button>
                                            </form>
                                            <form method="post" action="demandes.php?action=traiter" class="inline">
                                                <input type="hidden" name="demande_id" value="<?= htmlspecialchars($demande['id']) ?>">
                                                <input type="hidden" name="action" value="refuser">
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir refuser cette demande ?')">
                                                    Refuser
                                                </button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">Traitée</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>