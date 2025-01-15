<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-blue-600 text-white w-64 flex flex-col">
            <div class="p-5">
                <h2 class="text-2xl font-bold">Youdemy</h2>
                <p class="text-blue-200 text-sm mt-1">Alexandre Dupont</p>
            </div>
            <nav class="flex-1">
                <a href="#" class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-700">
                    <i data-feather="home" class="mr-3"></i>
                    Accueil
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-700">
                    <i data-feather="book" class="mr-3"></i>
                    Mes Cours
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-700">
                    <i data-feather="compass" class="mr-3"></i>
                    Découvrir
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-700">
                    <i data-feather="bookmark" class="mr-3"></i>
                    Favoris
                </a>
            </nav>
            <!-- Déconnexion -->
            <div class="p-5 border-t border-blue-500">
                <a href="#" class="flex items-center px-6 py-3 text-blue-100 hover:bg-blue-700">
                    <i data-feather="log-out" class="mr-3"></i>
                    Déconnexion
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Catalogue des Cours</h1>
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un cours..." 
                                class="w-96 px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i data-feather="search" class="absolute right-3 top-2.5 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </header>

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Category Filters -->
                <div class="flex space-x-4 mb-8 overflow-x-auto pb-4">
                    <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200">
                        Tous les cours
                    </button>
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100">
                        Programmation
                    </button>
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100">
                        Design
                    </button>
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100">
                        Marketing
                    </button>
                    <button class="px-4 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100">
                        Business
                    </button>
                </div>

                <!-- My Courses Section -->
                <section class="mb-12">
                    <h2 class="text-xl font-semibold mb-6">Mes Cours</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Course Card -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative pb-60">
                                <img src="/api/placeholder/400/240" alt="Course thumbnail" class="absolute h-full w-full object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-2 py-1 bg-green-500 text-white text-xs rounded-full">En cours</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">JavaScript Avancé</h3>
                                <p class="text-gray-600 text-sm mb-4">Maîtrisez les concepts avancés de JavaScript</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                        <span class="ml-2 text-sm text-gray-600">Dr. Sophie Martin</span>
                                    </div>
                                    <div class="flex items-center text-yellow-400">
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm">4.8</span>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i data-feather="clock" class="w-4 h-4 mr-1"></i>
                                            <span>Progression: 60%</span>
                                        </div>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            Continuer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Course Catalog -->
                <section>
                    <h2 class="text-xl font-semibold mb-6">Cours Recommandés</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Course Card -->
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="relative pb-60">
                                <img src="/api/placeholder/400/240" alt="Course thumbnail" class="absolute h-full w-full object-cover">
                                <button class="absolute top-4 right-4 p-2 bg-white rounded-full shadow hover:bg-gray-100">
                                    <i data-feather="heart" class="w-4 h-4 text-gray-600"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center mb-2">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Programmation</span>
                                </div>
                                <h3 class="font-semibold text-lg mb-2">React pour Débutants</h3>
                                <p class="text-gray-600 text-sm mb-4">Apprenez à créer des applications web modernes avec React</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                        <span class="ml-2 text-sm text-gray-600">Thomas Bernard</span>
                                    </div>
                                    <div class="flex items-center text-yellow-400">
                                        <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm">4.9</span>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t">
                                    <div class="flex justify-between items-center">
                                        <div class="text-lg font-bold text-gray-900">
                                            29.99 €
                                        </div>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            S'inscrire
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional course cards would go here -->
                    </div>
                </section>

                <!-- Course Details Modal (Hidden by default) -->
                <div class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full" id="courseModal">
                    <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold">React pour Débutants</h3>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-2">
                                <img src="/api/placeholder/800/400" alt="Course preview" class="rounded-lg w-full">
                                <div class="mt-6">
                                    <h4 class="text-lg font-semibold mb-2">À propos du cours</h4>
                                    <p class="text-gray-600">
                                        Un cours complet pour maîtriser React, de ses fondamentaux jusqu'aux concepts avancés.
                                        Vous apprendrez à créer des applications web modernes et réactives.
                                    </p>
                                    <h4 class="text-lg font-semibold mt-4 mb-2">Ce que vous apprendrez</h4>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                                            Les fondamentaux de React
                                        </li>
                                        <li class="flex items-center">
                                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                                            Gestion d'état avec Hooks
                                        </li>
                                        <li class="flex items-center">
                                            <i data-feather="check" class="w-4 h-4 text-green-500 mr-2"></i>
                                            Routing et navigation
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="text-3xl font-bold mb-4">29.99 €</div>
                                    <button class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mb-4">
                                        S'inscrire maintenant
                                    </button>
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <i data-feather="clock" class="w-4 h-4 mr-2 text-gray-500"></i>
                                            <span>12 heures de contenu</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i data-feather="file-text" class="w-4 h-4 mr-2 text-gray-500"></i>
                                            <span>54 leçons</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i data-feather="award" class="w-4 h-4 mr-2 text-gray-500"></i>
                                            <span>Certificat inclus</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>