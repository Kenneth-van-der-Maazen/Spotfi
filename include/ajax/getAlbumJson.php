<?php

if (isset($_POST['albumId'])) {
    require_once("../database.php");
    $pdo = new Database();

    $albumId = (int) $_POST['albumId'];


    $stmt = $pdo->execute("SELECT * FROM albums WHERE id = :id", ["id" => $albumId]);
    $album = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("POST albumId: " . $_POST['albumId']);
    if ($album) {
        echo json_encode($album);
    } else {
        echo json_encode(["error" => "Album not found"]);
    }
} else {
    echo json_encode(["error" => "No albumId provided"]);
}
?>