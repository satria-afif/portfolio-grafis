<?php
require_once '../config/database.php';

class ProjectRepository {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllProjects($limit = null) {
        $query = "SELECT * FROM projects ORDER BY created_at DESC";
        if ($limit) {
            $query .= " LIMIT " . (int)$limit;
        }
        $result = $this->db->query($query);
        
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
        
        return $projects;
    }
    public function getProjectById($id) {
        $query = "SELECT * FROM projects WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
}

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$projectRepo = new ProjectRepository($db);
$projects = $projectRepo->getAllProjects();

header('Content-Type: application/json');
echo json_encode($projects);
?>
