<?php



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"></script>
    <style>
        /* Styles personnalisés si nécessaire */
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-indigo-700 text-white w-64 flex flex-col">
            <div class="p-5">
                <h2 class="text-2xl font-bold">Espace Enseignant</h2>
                <p class="text-indigo-200 text-sm mt-1">Dr. <?php echo htmlspecialchars($_SESSION['user']['nom']); ?></p>
            </div>
            <nav class="flex-1">
                <a href="dashboard.php" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="bar-chart-2" class="mr-3"></i>
                    Statistiques
                </a>
                <a href="manage-courses.php" class="flex items-center px-6 py-3 text-indigo-100 bg-indigo-800">
                    <i data-feather="plus-circle" class="mr-3"></i>
                    Nouveau Cours
                </a>
                <a href="my-courses.php" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="book-open" class="mr-3"></i>
                    Mes Cours
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
                    <i data-feather="users" class="mr-3"></i>
                    Inscriptions
                </a>
            </nav>
            <!-- Déconnexion -->
            <div class="p-5 border-t border-indigo-600">
                <a href="../../assets/php/logout.php" class="flex items-center px-6 py-3 text-indigo-100 hover:bg-indigo-800">
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
                </div>
            </header>

            <main class="p-6">
                <!-- Formulaire pour ajouter un cours -->
                <form action="submit-course.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <!-- Titre du cours -->
                    <div>
                        <label for="course-title" class="block text-sm font-medium text-gray-700">Titre du cours</label>
                        <input type="text" name="course-title" id="course-title" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Description du cours -->
                    <div>
                        <label for="course-description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="course-description" id="course-description" rows="3" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <!-- Catégorie du cours -->
                    <div>
                        <label for="course-category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select name="course-category" id="course-category" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="Programmation">Programmation</option>
                            <option value="Design">Design</option>
                            <option value="Mathématiques">Mathématiques</option>
                            <option value="autre">Autre</option>
                        </select>
                        <div id="new-category" class="mt-2 hidden">
                            <input type="text" name="new-category" placeholder="Entrez une nouvelle catégorie" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>

                    <!-- Image du cours -->
                    <div>
                        <label for="course-image" class="block text-sm font-medium text-gray-700">Image du cours</label>
                        <input type="file" name="course-image" id="course-image" accept="image/*" class="mt-1 block w-full">
                    </div>

                    <!-- Choix entre vidéo ou contenu texte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type de contenu</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="content-type" value="video" checked class="form-radio">
                                <span class="ml-2">Vidéo</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="content-type" value="text" class="form-radio">
                                <span class="ml-2">Contenu texte</span>
                            </label>
                        </div>
                    </div>

                    <!-- Champ pour uploader une vidéo -->
                    <div id="video-upload" class="mt-4">
                        <label for="course-video" class="block text-sm font-medium text-gray-700">Vidéo du cours</label>
                        <input type="file" name="course-video" id="course-video" accept="video/*" class="mt-1 block w-full">
                    </div>

                    <!-- Éditeur de contenu texte -->
                    <div id="text-editor" class="mt-4 hidden">
                        <label for="course-content" class="block text-sm font-medium text-gray-700">Contenu du cours</label>
                        <textarea id="course-content" name="course-content" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <!-- Tags du cours -->
                    <div>
                        <label for="course-tags" class="block text-sm font-medium text-gray-700">Tags</label>
                        <input type="text" name="course-tags" id="course-tags" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ajoutez des tags, séparés par des virgules">
                    </div>

                    <!-- Bouton de soumission -->
                    <div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ajouter le cours
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
        // Initialiser Feather Icons
        feather.replace();

        // Gérer l'affichage dynamique des champs
        document.addEventListener('DOMContentLoaded', function() {
            const contentTypeRadios = document.querySelectorAll('input[name="content-type"]');
            const videoUploadDiv = document.getElementById('video-upload');
            const textEditorDiv = document.getElementById('text-editor');
            const categorySelect = document.getElementById('course-category');
            const newCategoryDiv = document.getElementById('new-category');

            // Gérer l'affichage des champs vidéo ou éditeur de texte
            contentTypeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'video') {
                        videoUploadDiv.style.display = 'block';
                        textEditorDiv.style.display = 'none';
                    } else {
                        videoUploadDiv.style.display = 'none';
                        textEditorDiv.style.display = 'block';
                    }
                });
            });

            // Gérer l'affichage du champ pour une nouvelle catégorie
            categorySelect.addEventListener('change', function() {
                if (this.value === 'autre') {
                    newCategoryDiv.style.display = 'block';
                } else {
                    newCategoryDiv.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>