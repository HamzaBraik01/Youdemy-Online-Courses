<?php
session_start();
require_once '../../classes/Enseignant.php';

if (!isset($_SESSION['utilisateur']) || !$_SESSION['utilisateur'] instanceof Enseignant) {
    header('Location: ../../public/login.php');
    exit();
}

// Afficher le contenu du tableau de bord des enseignants
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/4.4.1/chart.umd.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-indigo-700 text-white w-64 flex flex-col">
            <div class="p-5">
                <h2 class="text-2xl font-bold">Espace Enseignant</h2>
                <p class="text-indigo-200 text-sm mt-1">Dr. Sophie Martin</p>
            </div>
            <nav class="flex-1">
                <a href="#" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="plus-circle" class="mr-3"></i>
                    Nouveau Cours
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="book-open" class="mr-3"></i>
                    Mes Cours
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="users" class="mr-3"></i>
                    Inscriptions
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="bar-chart-2" class="mr-3"></i>
                    Statistiques
                </a>
            </nav>
            <!-- Déconnexion -->
            <div class="p-5 border-t border-indigo-600">
                <a href="#" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="log-out" class="mr-3"></i>
                    Déconnexion
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Tableau de Bord</h1>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
                        <i data-feather="plus" class="mr-2"></i>
                        Ajouter un cours
                    </button>
                </div>
            </header>

            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                <i data-feather="book"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Cours</h3>
                                <p class="text-2xl font-semibold">12</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i data-feather="users"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Étudiants</h3>
                                <p class="text-2xl font-semibold">458</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i data-feather="star"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Note Moyenne</h3>
                                <p class="text-2xl font-semibold">4.8/5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Management Section -->
                <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Mes Cours</h3>
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Rechercher un cours..." class="px-4 py-2 border rounded-lg">
                            <select class="px-4 py-2 border rounded-lg">
                                <option>Tous les cours</option>
                                <option>Actifs</option>
                                <option>En attente</option>
                                <option>Archivés</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiants</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière mise à jour</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="/api/placeholder/40/40" alt="Course" class="rounded">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">JavaScript Avancé</div>
                                                <div class="text-sm text-gray-500">8 modules • 24 leçons</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Programmation
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">245</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Il y a 2 jours</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</button>
                                        <button class="text-red-600 hover:text-red-900">Supprimer</button>
                                    </td>
                                </tr>
                                <!-- Additional course rows would go here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Inscriptions par Cours</h3>
                        <canvas id="enrollmentChart" height="200"></canvas>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Engagement des Étudiants</h3>
                        <canvas id="engagementChart" height="200"></canvas>
                    </div>
                </div>
            </main>
        </div>

        <!-- New Course Modal (Hidden by default) -->
        <div class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="newCourseModal">
            <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Ajouter un nouveau cours</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Titre du cours</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                                <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option>Programmation</option>
                                    <option>Design</option>
                                    <option>Marketing</option>
                                    <option>Business</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tags</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Séparés par des virgules">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contenu du cours</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <i data-feather="upload-cloud" class="mx-auto h-12 w-12 text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                            <span>Télécharger un fichier</span>
                                            <input type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">Video MP4, Documents PDF jusqu'à 2GB</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Créer le cours</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize Charts
        

        
    </script>
</body>
</html>