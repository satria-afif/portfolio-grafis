<?php
require_once '../config/database.php';
require_once '../includes/auth_check.php';

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$projectId = $_GET['id'] ?? 0;

if ($projectId) {
    $query = "DELETE FROM projects WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
}

header('Location: /admin/projects.php');
exit();
?>
