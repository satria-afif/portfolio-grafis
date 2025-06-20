<?php
require_once '../config/database.php';

class AuthService {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function authenticate($username, $password) {
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['logged_in'] = true;
                
                return true;
            }
        }
        
        return false;
    }
}

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$authService = new AuthService($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($authService->authenticate($username, $password)) {
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        header('Location: /admin/login.php?error=1');
        exit();
    }
}
?>
