<?php
class Database {
    private static $instance = null;
    private $connection;
    
    private $server = "localhost";
    private $database = "sekolah";
    private $username = "rangga";
    private $password = "rangga";

    private function __construct() {
        try {
            $this->connection = mysqli_connect(
                $this->server,
                $this->username,
                $this->password,
                $this->database
            );
            
            if (!$this->connection) {
                throw new Exception(mysqli_connect_error());
            }
            
            $this->connection->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function escape($string) {
        return mysqli_real_escape_string($this->connection, $string);
    }
}
?>
