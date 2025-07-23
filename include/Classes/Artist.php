<?php
    class Artist {

        private $pdo;
        private $id;
        // private $name;

        public function __construct($pdo, $id) {
            $this->pdo = $pdo;
            $this->id = $id;
        }

        public function getName() {
            $artistQuery = $this->pdo->execute("SELECT name FROM artists WHERE id = :id", ["id" => $this->id]);
            $artist = $artistQuery->fetch(PDO::FETCH_ASSOC);
            return $artist["name"];
        }
    }
?>