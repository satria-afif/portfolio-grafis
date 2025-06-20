<?php
require_once '../config/database.php';
require_once '../includes/auth_check.php';

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$projectId = $_GET['id'] ?? 0;

$projectRepo = new ProjectRepository($db);
$project = $projectRepo->getProjectById($projectId);

if (!$project) {
    header('Location: /admin/projects.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';

    $imagePath = $project['image_path'];

    // Handle file upload if a new image is provided
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "../public/assets/images/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $error = "File is not an image.";
        } elseif ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            $error = "Sorry, your file is too large.";
        } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = "/public/assets/images/" . basename($_FILES["image"]["name"]);
        } else {
            $error = "Sorry, there was an error uploading your file.";
        }
    }

    if (!isset($error)) {
        $query = "UPDATE projects SET title = ?, description = ?, category = ?, image_path = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssi", $title, $description, $category, $imagePath, $projectId);

        if ($stmt->execute()) {
            header('Location: admin/projects.php?success=1');
            exit();
        } else {
            $error = "Error updating project in database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - GraphicPort Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-light: #4f46e5;
            --primary-dark: #6366f1;
            --bg-light: #f9fafb;
            --bg-dark: #1f2937;
            --text-light: #111827;
            --text-dark: #f9fafb;
        }

        .dark {
            --primary: var(--primary-dark);
            --bg: var(--bg-dark);
            --text: var(--text-dark);
        }

        .light {
            --primary: var(--primary-light);
            --bg: var(--bg-light);
            --text: var(--text-light);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-center h-16 bg-gray-900 dark:bg-gray-800">
                    <span class="text-white font-bold">GraphicPort Admin</span>
                </div>
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto">
                    <nav class="flex-1 px-2 space-y-1">
                        <a href="/admin/dashboard.php" class="flex items-center px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md group">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        <a href="/admin/projects.php" class="flex items-center px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md group">
                            <i class="fas fa-project-diagram mr-3"></i>
                            Projects
                        </a>
                        <a href="/admin/add_project.php" class="flex items-center px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md group">
                            <i class="fas fa-plus-circle mr-3"></i>
                            Add Project
                        </a>
                        <a href="/admin/settings.php" class="flex items-center px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md group">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                    </nav>
                </div>
                <div class="p-4">
                    <a href="/admin/logout.php" class="flex items-center px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md group">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4">
                <div class="flex items-center">
                    <button class="md:hidden text-gray-500 dark:text-gray-300 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>

                    <div class="relative">
                        <button class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 rounded-full focus:outline-none">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-auto p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Project</h1>
                    <a href="/admin/projects.php" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Projects
                    </a>
                </div>

                <?php if (isset($error)): ?>
                    <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900 dark:border-red-700 dark:text-red-200">
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <form action="/admin/edit_project.php?id=<?php echo $projectId; ?>" method="POST" enctype="multipart/form-data">
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Project Title</label>
                                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700">
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700"><?php echo htmlspecialchars($project['description']); ?></textarea>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                                <select id="category" name="category" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700">
                                    <option value="logo" <?php echo $project['category'] === 'logo' ? 'selected' : ''; ?>>Logo</option>
                                    <option value="poster" <?php echo $project['category'] === 'poster' ? 'selected' : ''; ?>>Poster</option>
                                    <option value="banner" <?php echo $project['category'] === 'banner' ? 'selected' : ''; ?>>Banner</option>
                                    <option value="branding" <?php echo $project['category'] === 'branding' ? 'selected' : ''; ?>>Branding</option>
                                    <option value="illustration" <?php echo $project['category'] === 'illustration' ? 'selected' : ''; ?>>Illustration</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Image</label>
                                <img src="<?php echo $project['image_path']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="h-32 w-auto rounded-md">
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Image (Leave empty to keep current)</label>
                                <div class="mt-1 flex items-center">
                                    <label for="image" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload new file</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1 text-sm text-gray-500 dark:text-gray-400">or drag and drop</p>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 5MB</p>

                                <div class="flex justify-end space-x-3">
                                    <a href="/admin/projects.php" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        Cancel
                                    </a>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                        <i class="fas fa-save mr-2"></i> Update Project
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/theme.js"></script>
    <script src="/admin/assets/js/edit_project.js"></script>
</body>

</html>