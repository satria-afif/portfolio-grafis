<?php
require_once '../config/database.php';

$dbConfig = DatabaseConfig::getInstance();
$db = $dbConfig->getConnection();

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$email = 'admin@example.com';

$query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param("sss", $username, $password, $email);
$stmt->execute();

echo "Admin user created successfully!";
?>
