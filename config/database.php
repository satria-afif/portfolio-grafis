<?php
class DatabaseConfig {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $this->connection = new mysqli('localhost', 'root', '', 'portfolio_grafis');
        
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DatabaseConfig();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}
?>