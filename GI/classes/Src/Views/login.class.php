<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Inscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-4">Gestion des Inscriptions</h1>
        <p class="text-center text-gray-400 mb-6">Connectez-vous pour accéder à l'application</p>
        <form class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-300">Nom d'utilisateur</label>
                <input type="text" id="username" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nom d'utilisateur">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Mot de passe</label>
                <input type="password" id="password" class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Mot de passe">
            </div>
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-200">Se connecter</button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-400">Comptes de démonstration :</p>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div class="bg-gray-700 p-2 rounded-md">
                    <p class="text-sm">RP</p>
                    <p class="text-xs text-gray-400">Identifiant: rp@suyo.sn</p>
                    <p class="text-xs text-gray-400">Mot de passe: passer123@</p>
                </div>
                <div class="bg-gray-700 p-2 rounded-md">
                    <p class="text-sm">Attaché</p>
                    <p class="text-xs text-gray-400">Identifiant: attache@suyo.sn</p>
                    <p class="text-xs text-gray-400">Mot de passe: passer123@</p>
                </div>
                <div class="bg-gray-700 p-2 rounded-md">
                    <p class="text-sm">Étudiant</p>
                    <p class="text-xs text-gray-400">Identifiant: etudiant@suyo.sn</p>
                    <p class="text-xs text-gray-400">Mot de passe: passer123@</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>