<?php
require_once '../config/database.php';
require_once '../includes/auth_check.php';
require_once '../includes/get_projects.php'; // Tambahkan baris ini

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();
$dashboard = new AdminDashboard($db);

class AdminDashboard {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getProjectCount() {
        $query = "SELECT COUNT(*) as count FROM projects";
        $result = $this->db->query($query);
        return $result->fetch_assoc()['count'];
    }
}

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$dashboard = new AdminDashboard($db);
$projectCount = $dashboard->getProjectCount();
?>

<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GraphicPort</title>
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
                        <a href="/admin/dashboard.php" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-md group">
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
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Stats Cards -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300">
                                <i class="fas fa-project-diagram text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Projects</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white"><?php echo $projectCount; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                                <i class="fas fa-eye text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Views</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white">1,234</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Messages</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white">12</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Projects -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Recent Projects</h2>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php
                        $projectRepo = new ProjectRepository($db);
                        $recentProjects = $projectRepo->getAllProjects(5);
                        
                        if (empty($recentProjects)): ?>
                            <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                                No projects found
                            </div>
                        <?php else: ?>
                            <?php foreach ($recentProjects as $project): ?>
                                <div class="p-6 flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16 rounded-md overflow-hidden">
                                        <img src="<?php echo $project['image_path']; ?>" alt="<?php echo $project['title']; ?>" class="h-full w-full object-cover">
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white"><?php echo $project['title']; ?></h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo ucfirst($project['category']); ?></p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="/admin/edit_project.php?id=<?php echo $project['id']; ?>" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 text-right">
                        <a href="/admin/projects.php" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">View all projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/theme.js"></script>
    <script src="/admin/assets/js/dashboard.js"></script>
</body>
</html>
