<?php

if (isset($_POST['songId'])) {
    require_once("../database.php");
    $pdo = new Database();

    // Haal songId op en cast naar integer om SQL injectie te vermijden
    $songId = (int) $_POST['songId'];


    $stmt = $pdo->execute("SELECT * FROM songs WHERE id = :id", ["id" => $songId]);
    $song = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("POST songId: " . $_POST['songId']);
    if ($song) {
        echo json_encode($song);
    } else {
        echo json_encode(["error" => "Song not found"]);
    }
} else {
    echo json_encode(["error" => "No songId provided"]);
}
?>