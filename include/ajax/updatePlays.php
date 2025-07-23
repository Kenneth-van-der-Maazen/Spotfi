<?php

if (isset($_POST['songId'])) {
    require_once("../database.php");
    $pdo = new Database();

    $songId = (int) $_POST['songId'];


    $stmt = $pdo->execute("UPDATE songs SET plays = plays + 1 WHERE id = :id", ["id" => $songId]);
}
?>