<?php

class Database {
    public $pdo;

    public function __construct($db = "spotlite", $host = "localhost", $user = "root", $password = "")
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Verbinding met de database is gevestigd.<br>";
        } catch (PDOException $e) {
            echo "Er is een fout opgetreden: " . $e->getMessage();
        }
    }

    public function execute($sql, $placeholders = null)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }
}

// $pdo = new Database();

?>