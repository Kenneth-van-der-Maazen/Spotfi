<?php
    class Album {

        private $pdo;
        private $id;
        private $title;
        private $artistId;
        private $genre;
        private $artworkPath;

        public function __construct($pdo, $id) {
            $this->pdo = $pdo;
            $this->id = $id;

            $query = $this->pdo->execute("SELECT * FROM albums WHERE id = :id", ["id" => $this->id]);
            $album = $query->fetch(PDO::FETCH_ASSOC);

            $this->title = $album['title'];
            $this->artistId = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtist() {
            return new Artist($this->pdo, $this->artistId);
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getArtworkPath() {
            return $this->artworkPath;
        }

        public function getNumberOfSongs() {
            $query = $this->pdo->execute("SELECT id FROM songs WHERE album = :id", ["id" => $this->id]);
            return $query->rowCount();
        }

        public function getSongIds() {
            $query = $this->pdo->execute("SELECT id FROM songs WHERE album = :id ORDER BY albumOrder ASC", ["id" => $this->id]);
            $query->execute(["id" => $this->id]);
            
            // $array = array();
            $array = [];

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                // array_push($array, $row['id']);
                $array[] = $row['id'];
            }

            return $array;
        }
    }
?>