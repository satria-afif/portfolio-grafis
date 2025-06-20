<?php
require_once '../config/database.php';

class ContactService {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function saveContact($name, $email, $subject, $message) {
        $query = "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        return $stmt->execute();
    }
}

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$contactService = new ContactService($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    if ($contactService->saveContact($name, $email, $subject, $message)) {
        echo json_encode(['success' => true, 'message' => 'Thank you for your message!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send your message. Please try again.']);
    }
}
?>
