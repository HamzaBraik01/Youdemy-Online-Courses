<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/4.4.1/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 flex flex-col">
            <div class="p-5">
                <h2 class="text-2xl font-bold">Youdemy</h2>
            </div>
            <nav class="flex-1">
                <a href="#validation-comptes" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="users" class="mr-3"></i>
                    Validation Comptes
                </a>
                <a href="#gestion-utilisateurs" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="user-check" class="mr-3"></i>
                    Gestion Utilisateurs
                </a>
                <a href="#gestion-contenus" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="book" class="mr-3"></i>
                    Gestion Contenus
                </a>
                <a href="#gestion-tags" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="tag" class="mr-3"></i>
                    Gestion Tags
                </a>
                <a href="#statistiques" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="bar-chart-2" class="mr-3"></i>
                    Statistiques
                </a>
            </nav>
            <!-- Déconnexion -->
            <div class="p-5 border-t border-gray-700">
                <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="log-out" class="mr-3"></i>
                    Déconnexion
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Tableau de Bord</h1>
                </div>
            </header>

            <main class="p-6">
                <!-- Section Validation Comptes -->
                <section id="validation-comptes" class="hidden">
                    <h2 class="text-xl font-bold mb-4">Validation Comptes</h2>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p>Contenu de la section Validation Comptes.</p>
                    </div>
                </section>

                <!-- Section Gestion Utilisateurs -->
                <section id="gestion-utilisateurs" class="hidden">
                    <h2 class="text-xl font-bold mb-4">Gestion Utilisateurs</h2>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p>Contenu de la section Gestion Utilisateurs.</p>
                    </div>
                </section>

                <!-- Section Gestion Contenus -->
                <section id="gestion-contenus" class="hidden">
                    <h2 class="text-xl font-bold mb-4">Gestion Contenus</h2>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p>Contenu de la section Gestion Contenus.</p>
                    </div>
                </section>

                <!-- Section Gestion Tags -->
                <section id="gestion-tags" class="hidden">
                    <h2 class="text-xl font-bold mb-4">Gestion Tags</h2>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p>Contenu de la section Gestion Tags.</p>
                    </div>
                </section>

                <!-- Section Statistiques -->
                <section id="statistiques" class="hidden">
                    <h2 class="text-xl font-bold mb-4">Statistiques</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold mb-4">Répartition par Catégorie</h3>
                            <canvas id="categoryChart" height="200"></canvas>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold mb-4">Top 3 Enseignants</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" alt="Teacher 1" class="rounded-full">
                                    <div class="ml-4 flex-1">
                                        <h4 class="font-semibold">Dr. Sophie Martin</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 95%"></div>
                                        </div>
                                    </div>
                                    <span class="ml-4 text-sm font-semibold">28 cours</span>
                                </div>
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" alt="Teacher 2" class="rounded-full">
                                    <div class="ml-4 flex-1">
                                        <h4 class="font-semibold">Prof. Thomas Bernard</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 85%"></div>
                                        </div>
                                    </div>
                                    <span class="ml-4 text-sm font-semibold">24 cours</span>
                                </div>
                                <div class="flex items-center">
                                    <img src="/api/placeholder/40/40" alt="Teacher 3" class="rounded-full">
                                    <div class="ml-4 flex-1">
                                        <h4 class="font-semibold">Dr. Marie Dubois</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                        </div>
                                    </div>
                                    <span class="ml-4 text-sm font-semibold">20 cours</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize Charts
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Programmation', 'Data Science', 'Design', 'Marketing', 'Business'],
                datasets: [{
                    data: [30, 25, 20, 15, 10],
                    backgroundColor: [
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Gestion de la navigation
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                document.querySelectorAll('main section').forEach(section => {
                    section.classList.add('hidden');
                });
                document.getElementById(targetId).classList.remove('hidden');
            });
        });

        // Afficher la première section par défaut
        document.querySelector('nav a').click();
    </script>
</body>
</html>