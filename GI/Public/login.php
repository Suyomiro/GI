<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';

if (SessionManager::isLoggedIn()) {
    $user = SessionManager::getUser();
    switch ($user['role']) {
        case 'RP':
            header('Location: /GI/Public/RP/classes.php');
            break;
        case 'ATTACHE':
            header('Location: /GI/Public/Attache/inscriptions.php');
            break;
        case 'ETUDIANT':
            header('Location: /GI/Public/Etudiant/dashboard.php');
            break;
    }
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch();
            
            if ($user) {
                SessionManager::login($user);
                
                switch ($user['role']) {
                    case 'RP':
                        header('Location: /GI/Public/RP/classes.php');
                        break;
                    case 'ATTACHE':
                        header('Location: /GI/Public/Attache/inscriptions.php');
                        break;
                    case 'ETUDIANT':
                        header('Location: /GI/Public/Etudiant/dashboard.php');
                        break;
                }
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect';
            }
        } catch (Exception $e) {
            $error = 'Erreur de connexion à la base de données';
        }
    } else {
        $error = 'Veuillez remplir tous les champs';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des Inscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-4">Gestion des Inscriptions</h1>
        <p class="text-center text-gray-400 mb-6">Connectez-vous pour accéder à l'application</p>
        
        <?php if ($error): ?>
            <div class="bg-red-600 text-white p-3 rounded mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Email">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Mot de passe</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Mot de passe">
            </div>
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200">Se connecter</button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-400">Comptes de démonstration :</p>
            <div class="grid grid-cols-1 gap-4 mt-2">
                <div class="bg-gray-700 p-2 rounded-md">
                    <p class="text-sm font-semibold">Responsable Pédagogique</p>
                    <p class="text-xs text-gray-400">Email: rp@suyo.sn</p>
                    <p class="text-xs text-gray-400">Mot de passe: passer123@</p>
                </div>
                <div class="bg-gray-700 p-2 rounded-md">
                    <p class="text-sm font-semibold">Attaché de Classe</p>
                    <p class="text-xs text-gray-400">Email: attache@suyo.sn</p>
                    <p class="text-xs text-gray-400">Mot de passe: passer123@</p>
                </div>
                <div class="bg-gray-700 p-2 rounded-md">
                    <p class="text-sm font-semibold">Étudiant</p>
                    <p class="text-xs text-gray-400">Email: etudiant@suyo.sn</p>
                    <p class="text-xs text-gray-400">Mot de passe: passer123@</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>