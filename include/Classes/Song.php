<?php
    class Song {

        private $pdo;
        private $id;
        private $sqlData;
        private $title;
        private $artistId;
        private $albumId;
        private $genre;
        private $duration;
        private $path;

        public function __construct($pdo, $id) {
            $this->pdo = $pdo;
            $this->id = $id;

            $query = $this->pdo->execute("SELECT * FROM songs WHERE id = :id", ["id" => $this->id]);
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            $this->title = $this->sqlData['title'];
            $this->artistId = $this->sqlData['artist'];
            $this->albumId = $this->sqlData['album'];
            $this->genre = $this->sqlData['genre'];
            $this->duration = $this->sqlData['duration'];
            $this->path = $this->sqlData['path'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getId() {
            return $this->id;
        }

        public function getArtist() {
            return new Artist($this->pdo, $this->artistId);
        }

        public function getAlbum() {
            return new Album($this->pdo, $this->albumId);
        }

        public function getPath() {
            return $this->path;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function getGenre() {
            return $this->genre;
        }
    }
?>