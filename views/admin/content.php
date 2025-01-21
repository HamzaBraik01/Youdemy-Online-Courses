<?php
session_start();
require_once '../../classes/Database.php';
require_once '../../classes/Administrateur.php';
require_once '../../classes/Role.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Administrateur') {
    header('Location: ../../public/login.php');
    exit();
}

$admin = new Administrateur(
    $_SESSION['user']['nom'],
    $_SESSION['user']['email'],
    '',
    new Role(1, $_SESSION['user']['role']),
    $_SESSION['user']['status']
);

// Traitement des actions (activer/suspendre et supprimer)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($id && $action) {
        $db = Database::getInstance()->getConnection();

        if ($action === 'update-status') {
            $status = $_POST['status'] ?? null;
            if ($status !== null) {
                $stmt = $db->prepare("
                    UPDATE Cours 
                    SET status = :status 
                    WHERE id = :id
                ");
                $stmt->bindParam(':status', $status, PDO::PARAM_INT);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Le statut du cours a été mis à jour avec succès.";
                    $_SESSION['message_type'] = 'success';
                } else {
                    $_SESSION['error'] = "Une erreur s'est produite lors de la mise à jour du statut.";
                }
            } else {
                $_SESSION['error'] = "Données invalides.";
            }
        } elseif ($action === 'delete') {
            // Supprimer les enregistrements dépendants
            $stmt = $db->prepare("DELETE FROM video WHERE cours_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM contexte WHERE cours_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM course_tag WHERE id_cours = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM enseignant_cours WHERE id_cours = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM student_courses WHERE id_cours = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Supprimer le cours
            $stmt = $db->prepare("DELETE FROM cours WHERE id = :id");
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Le cours a été supprimé avec succès.";
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['error'] = "Une erreur s'est produite lors de la suppression du cours.";
            }
        } else {
            $_SESSION['error'] = "Action non reconnue.";
        }
    } else {
        $_SESSION['error'] = "Données invalides.";
    }

    header('Location: content.php');
    exit();
}

// Récupérer les contenus
$contenus = $admin->gererContenu();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Contenus - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.1/feather.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 flex flex-col">
            <div class="p-5">
                <h2 class="text-2xl font-bold">Youdemy</h2>
            </div>
            <nav class="flex-1">
                <a href="dashboard.php" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="bar-chart-2" class="mr-3"></i>
                    Statistiques
                </a>
                <a href="Validation_Comptes.php" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="users" class="mr-3"></i>
                    Validation Comptes
                </a>
                <a href="manage-users.php" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="user-check" class="mr-3"></i>
                    Gestion Utilisateurs
                </a>
                <a href="manage-content.php" class="flex items-center px-6 py-3 text-gray-300 bg-gray-700">
                    <i data-feather="book" class="mr-3"></i>
                    Gestion Contenus
                </a>
                <a href="tagManager.php" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="tag" class="mr-3"></i>
                    Gestion Tags
                </a>
            </nav>
            <!-- Déconnexion -->
            <div class="p-5 border-t border-gray-700">
                <a href="../../assets/php/logout.php" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <i data-feather="log-out" class="mr-3"></i>
                    Déconnexion
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Contenus</h1>
                    <div class="text-gray-600">
                        Bienvenue, <?php echo htmlspecialchars($_SESSION['user']['nom']); ?>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <!-- Afficher les messages de succès ou d'erreur -->
                <?php if (isset($_SESSION['message'])): ?>
                    <?php
                    $bgColor = ($_SESSION['message_type'] === 'success') ? 'bg-green-100 border-green-500 text-green-700' : 'bg-orange-100 border-orange-500 text-orange-700';
                    ?>
                    <div class="<?php echo $bgColor; ?> border-l-4 p-4 mb-4" role="alert">
                        <div class="flex items-center">
                            <i data-feather="check-circle" class="w-6 h-6 mr-2"></i>
                            <p><?php echo $_SESSION['message']; ?></p>
                        </div>
                    </div>
                    <?php
                    // Supprimer les messages après affichage
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                    ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <div class="flex items-center">
                            <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                            <p><?php echo $_SESSION['error']; ?></p>
                        </div>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Section Cours -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-4">Gestion des contenus</h2>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table id="Gestion_des_contenus" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Cours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Enseignant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Catégorie</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($contenus as $contenu): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($contenu['cours_titre']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($contenu['enseignant_nom']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($contenu['categorie_name']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $contenu['cours_status'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                                <?php echo $contenu['cours_status'] == 1 ? 'Actif' : 'Inactif'; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex flex-row space-x-2">
                                                <!-- Bouton Activer/Désactiver -->
                                                <form action="" method="POST" class="inline">
                                                    <input type="hidden" name="id" value="<?php echo $contenu['cours_id']; ?>">
                                                    <input type="hidden" name="action" value="update-status">
                                                    <input type="hidden" name="status" value="<?php echo $contenu['cours_status'] == 1 ? 0 : 1; ?>">
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md flex items-center" title="<?php echo $contenu['cours_status'] == 1 ? 'Désactiver' : 'Activer'; ?>">
                                                        <i data-feather="<?php echo $contenu['cours_status'] == 1 ? 'pause' : 'play'; ?>" class="w-4 h-4"></i>
                                                    </button>
                                                </form>

                                                <!-- Bouton Supprimer -->
                                                <form action="" method="POST" class="inline">
                                                    <input type="hidden" name="id" value="<?php echo $contenu['cours_id']; ?>">
                                                    <input type="hidden" name="action" value="delete">
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md flex items-center" title="Supprimer">
                                                        <i data-feather="trash-2" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize DataTables
        $(document).ready(function() {
            $('#Gestion_des_contenus').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
                language: {
                    search: "Rechercher :",
                    searchPlaceholder: "Nom, email...",
                    paginate: {
                        first: "Premier",
                        last: "Dernier",
                        next: "Suivant",
                        previous: "Précédent"
                    }
                },
                dom: '<"flex justify-between items-center mb-4"<"flex-1"l><"flex-1"f>>rt<"flex justify-between items-center mt-4"<"flex-1"i><"flex-1"p>>',
                initComplete: function() {
                    $('.dataTables_filter input')
                        .addClass('pl-4 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500');
                }
            });
        });
    </script>
</body>
</html>