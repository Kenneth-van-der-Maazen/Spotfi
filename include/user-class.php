<?php
require 'database.php';

// $pdo = new Database();

class User {
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    // Functie om nieuwe gebruiker accounts aan te maken
    public function registerUser($first_name, $last_name, $email, $user_name, $password, $confirm_password) {
        if ($password == $confirm_password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->pdo->execute("INSERT INTO users (first_name, last_name, email, user_name, password) VALUES (:first_name, :last_name, :email, :user_name, :password)",
            [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "user_name" => $user_name,
                "password" => $hash
            ]);
        }
    }

    // Functie om de gebruiker te kunnen inloggen
    public function login($user_name) {
        return $this->pdo->execute("SELECT * FROM users WHERE user_name = :user_name", ["user_name" => $user_name])->fetch();
    }

    // Functie om gebruikers informatie op te halen met behulp van userID
    public function getUserInfo($user_id) {
        return $this->pdo->execute("SELECT * FROM users WHERE user_id = :user_id", ["user_id" => $user_id])->fetch();
    }

    public function getUserById($id) {
        return $this->pdo->execute("SELECT * FROM users WHERE user_id = :id", ["id" => $id])->fetch();
    }
}

$pdo = new Database();
?>