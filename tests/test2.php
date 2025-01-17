<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Youdemy</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-indigo-700 text-white">
        <div class="p-6">
            <h1 class="text-2xl font-bold">Youdemy Admin</h1>
        </div>
        <nav class="mt-6">
            <a href="#" class="block px-6 py-3 hover:bg-indigo-600 transition-colors">
                <span class="ml-2">Tableau de bord</span>
            </a>
            <a href="#" class="block px-6 py-3 hover:bg-indigo-600 transition-colors">
                <span class="ml-2">Gestion Utilisateurs</span>
            </a>
            <a href="#" class="block px-6 py-3 hover:bg-indigo-600 transition-colors">
                <span class="ml-2">Cours & Catégories</span>
            </a>
            <a href="#" class="block px-6 py-3 hover:bg-indigo-600 transition-colors">
                <span class="ml-2">Tags</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Tableau de bord</h2>
            <div class="flex items-center space-x-4">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                    Exporter les stats
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm font-medium">Total Cours</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2" id="totalCourses">245</p>
                <div class="text-green-600 text-sm">+12% ce mois</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm font-medium">Total Étudiants</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2" id="totalStudents">1,234</p>
                <div class="text-green-600 text-sm">+5% ce mois</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm font-medium">Total Enseignants</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2" id="totalTeachers">48</p>
                <div class="text-yellow-600 text-sm">+2% ce mois</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm font-medium">Revenus Mensuels</h3>
                <p class="text-3xl font-bold text-gray-800 mb-2">15,780 €</p>
                <div class="text-green-600 text-sm">+8% ce mois</div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Répartition des cours par catégorie</h3>
                <canvas id="courseDistribution" height="300"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 3 Enseignants</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" class="w-10 h-10 rounded-full" alt="Teacher 1">
                        <div class="ml-4">
                            <h4 class="font-medium">Marie Dubois</h4>
                            <p class="text-sm text-gray-500">12 cours - 856 étudiants</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" class="w-10 h-10 rounded-full" alt="Teacher 2">
                        <div class="ml-4">
                            <h4 class="font-medium">Jean Martin</h4>
                            <p class="text-sm text-gray-500">8 cours - 654 étudiants</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" class="w-10 h-10 rounded-full" alt="Teacher 3">
                        <div class="ml-4">
                            <h4 class="font-medium">Sophie Bernard</h4>
                            <p class="text-sm text-gray-500">6 cours - 542 étudiants</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Activités Récentes</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-3 px-4">Action</th>
                            <th class="text-left py-3 px-4">Utilisateur</th>
                            <th class="text-left py-3 px-4">Date</th>
                            <th class="text-left py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">Nouveau cours ajouté</td>
                            <td class="py-3 px-4">Marie Dubois</td>
                            <td class="py-3 px-4">Il y a 2h</td>
                            <td class="py-3 px-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Validé</span></td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">Demande d'inscription enseignant</td>
                            <td class="py-3 px-4">Pierre Martin</td>
                            <td class="py-3 px-4">Il y a 3h</td>
                            <td class="py-3 px-4"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">En attente</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Initialisation du graphique de distribution des cours
        const ctx = document.getElementById('courseDistribution').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Développement Web', 'Design', 'Marketing', 'Business', 'Langues'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        '#4F46E5',
                        '#7C3AED',
                        '#EC4899',
                        '#F59E0B',
                        '#10B981'
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

        // Animation des compteurs
        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            let currentValue = 0;
            const duration = 1000;
            const steps = 50;
            const increment = targetValue / steps;

            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= targetValue) {
                    clearInterval(timer);
                    currentValue = targetValue;
                }
                element.textContent = Math.round(currentValue).toLocaleString();
            }, duration / steps);
        }

        // Démarrer les animations
        animateCounter('totalCourses', 245);
        animateCounter('totalStudents', 1234);
        animateCounter('totalTeachers', 48);
    </script>
</body>
</html>