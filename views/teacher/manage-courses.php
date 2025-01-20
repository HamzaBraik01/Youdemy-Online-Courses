<?php
session_start();
require_once '../../classes/Database.php';
require_once '../../classes/Role.php';
require_once '../../classes/Enseignant.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Enseignant') {
    header('Location: ../../public/login.php');
    exit();
}

$_SESSION['user']['role_id'] = 2;
$Enseignant = new Enseignant(
    $_SESSION['user']['nom'],
    $_SESSION['user']['email'],
    '',
    new Role(2, $_SESSION['user']['role']),
    $_SESSION['user']['status']
);
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
        [contenteditable="true"]:focus {
            outline: none;
        }
        .form-container {
            background-color: #f9fafb;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
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
                    <h1 class="text-2xl font-bold text-gray-800">Nouveau Cours</h1>
                </div>
            </header>

            <main class="p-6">
                <div class="max-w-4xl mx-auto form-container">
                    <form id="courseForm" method="POST" action="process_course.php" enctype="multipart/form-data" class="space-y-6">
                        <!-- Titre du cours -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i data-feather="book" class="mr-2"></i>
                                Titre du cours
                            </label>
                            <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i data-feather="align-left" class="mr-2"></i>
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                        </div>

                        <!-- Catégorie -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i data-feather="folder" class="mr-2"></i>
                                Catégorie
                            </label>
                            <div class="flex gap-4">
                                <select id="category" name="category" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Sélectionnez une catégorie</option>
                                    <?php  ?>
                                    <option value="autre">Autre</option>
                                </select>
                                <input type="text" id="newCategory" name="newCategory" placeholder="Nouvelle catégorie" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 hidden">
                            </div>
                        </div>

                        <!-- Image du cours -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i data-feather="image" class="mr-2"></i>
                                Image du cours
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Télécharger une image</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*" required>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG jusqu'à 10MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Type de contenu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i data-feather="type" class="mr-2"></i>
                                Type de contenu
                            </label>
                            <div class="flex gap-4 mb-4">
                                <label class="flex items-center">
                                    <input type="radio" name="contentType" value="video" class="form-radio h-4 w-4 text-indigo-600" required>
                                    <span class="ml-2">Vidéo</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="contentType" value="text" class="form-radio h-4 w-4 text-indigo-600">
                                    <span class="ml-2">Contenu textuel</span>
                                </label>
                            </div>

                            <!-- Zone vidéo -->
                            <div id="videoUpload" class="hidden">
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="video" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Télécharger une vidéo</span>
                                                <input id="video" name="video" type="file" class="sr-only" accept="video/*">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">MP4, WebM jusqu'à 1GB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Éditeur de texte -->
                            <div id="textEditor" class="hidden">
                                <div class="border border-gray-300 rounded-md">
                                    <div class="bg-gray-50 p-2 border-b border-gray-300 flex flex-wrap gap-2">
                                        <button type="button" class="p-2 hover:bg-gray-200 rounded" onclick="execCommand('bold')">
                                            <i data-feather="bold"></i>
                                        </button>
                                        <button type="button" class="p-2 hover:bg-gray-200 rounded" onclick="execCommand('italic')">
                                            <i data-feather="italic"></i>
                                        </button>
                                        <button type="button" class="p-2 hover:bg-gray-200 rounded" onclick="execCommand('underline')">
                                            <i data-feather="underline"></i>
                                        </button>
                                        <button type="button" class="p-2 hover:bg-gray-200 rounded" onclick="execCommand('insertOrderedList')">
                                            <i data-feather="list"></i>
                                        </button>
                                        <button type="button" class="p-2 hover:bg-gray-200 rounded" onclick="execCommand('insertUnorderedList')">
                                            <i data-feather="list"></i>
                                        </button>
                                    </div>
                                    <div contenteditable="true" id="editor" class="p-4 min-h-[200px]"></div>
                                    <input type="hidden" name="content" id="hiddenContent">
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i data-feather="tag" class="mr-2"></i>
                                Tags
                            </label>
                            <div class="flex flex-wrap gap-2 mb-2" id="tagContainer">
                                <!-- Tags prédéfinis -->
                                <?php
                                $predefinedTags = ['Programmation', 'Mathématiques', 'Physique', 'Chimie', 'Biologie', 'Histoire', 'Géographie'];
                                foreach ($predefinedTags as $tag) {
                                    echo '<button type="button" onclick="addPredefinedTag(\'' . $tag . '\')" class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full hover:bg-indigo-200">' . $tag . '</button>';
                                }
                                ?>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" id="tagInput" placeholder="Ajouter un tag" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <button type="button" onclick="addTag()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                    Ajouter
                                </button>
                            </div>
                            <input type="hidden" name="tags" id="hiddenTags">
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Créer le cours
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialiser les icônes Feather
        feather.replace();

        // Gestion de la catégorie "Autre"
        document.getElementById('category').addEventListener('change', function() {
            const newCategoryInput = document.getElementById('newCategory');
            if (this.value === 'autre') {
                newCategoryInput.classList.remove('hidden');
                newCategoryInput.required = true;
            } else {
                newCategoryInput.classList.add('hidden');
                newCategoryInput.required = false;
            }
        });

        // Gestion du type de contenu
        document.querySelectorAll('input[name="contentType"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const videoUpload = document.getElementById('videoUpload');
                const textEditor = document.getElementById('textEditor');
                const videoInput = document.getElementById('video');
                
                if (this.value === 'video') {
                    videoUpload.classList.remove('hidden');
                    textEditor.classList.add('hidden');
                    videoInput.required = true;
                    editor.textContent = '';
                } else {
                    videoUpload.classList.add('hidden');
                    textEditor.classList.remove('hidden');
                    videoInput.required = false;
                }
            });
        });

        // Prévisualisation de l'image
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('img');
                        preview.src = e.target.result;
                        preview.classList.add('mt-2', 'max-h-48', 'mx-auto');
                        
                        // Supprimer l'ancienne prévisualisation s'il y en a une
                        const oldPreview = this.parentElement.querySelector('img');
                        if (oldPreview) {
                            oldPreview.remove();
                        }
                        
                        this.parentElement.appendChild(preview);
                    }.bind(this.parentElement);
                    reader.readAsDataURL(file);
                } else {
                    alert('Veuillez sélectionner une image valide.');
                    this.value = '';
                }
            }
        });

        // Fonctions de l'éditeur de texte
        function execCommand(command) {
            document.execCommand(command, false, null);
            document.getElementById('editor').focus();
        }

        // Gestion des tags
        let tags = new Set();

        function addTag() {
            const input = document.getElementById('tagInput');
            const tag = input.value.trim();
            
            if (tag && !tags.has(tag)) {
                tags.add(tag);
                updateTagDisplay();
                updateHiddenTags();
                input.value = '';
            }
        }

        function addPredefinedTag(tag) {
            if (!tags.has(tag)) {
                tags.add(tag);
                updateTagDisplay();
                updateHiddenTags();
            }
        }

        function removeTag(tag) {
            tags.delete(tag);
            updateTagDisplay();
            updateHiddenTags();
        }

        function updateTagDisplay() {
            const container = document.getElementById('tagContainer');
            container.innerHTML = '';
            
            tags.forEach(tag => {
                const tagElement = document.createElement('div');
                tagElement.className = 'flex items-center gap-1 px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full';
                tagElement.innerHTML = `
                    <span>${tag}</span>
                    <button type="button" onclick="removeTag('${tag}')" class="text-indigo-600 hover:text-indigo-800">
                        <i data-feather="x"></i>
                    </button>
                `;
                container.appendChild(tagElement);
            });
            
            feather.replace();
        }

        function updateHiddenTags() {
            document.getElementById('hiddenTags').value = Array.from(tags).join(',');
        }

        // Ajouter tag avec la touche Entrée
        document.getElementById('tagInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTag();
            }
        });

        // Gestion de la soumission du formulaire
        document.getElementById('courseForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Sauvegarder le contenu de l'éditeur dans le champ caché
            const editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('hiddenContent').value = editorContent;

            // Validation supplémentaire
            const contentType = document.querySelector('input[name="contentType"]:checked');
            if (!contentType) {
                alert('Veuillez sélectionner un type de contenu');
                return;
            }

            if (contentType.value === 'video' && !document.getElementById('video').files.length) {
                alert('Veuillez sélectionner une vidéo');
                return;
            }

            if (contentType.value === 'text' && !editorContent.trim()) {
                alert('Veuillez ajouter du contenu textuel');
                return;
            }

            // Soumettre le formulaire
            this.submit();
        });

        // Vérification de la taille des fichiers
        document.getElementById('video').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.size > 1024 * 1024 * 1024) { // 1GB
                alert('La taille de la vidéo ne doit pas dépasser 1GB');
                this.value = '';
            }
        });

        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.size > 10 * 1024 * 1024) { // 10MB
                alert('La taille de l\'image ne doit pas dépasser 10MB');
                this.value = '';
            }
        });
    </script>
</body>
</html>