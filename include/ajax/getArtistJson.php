<?php


if (isset($_POST['artistId'])) {
    require_once("../database.php");
    $pdo = new Database();

    $artistId = (int) $_POST['artistId'];


    $stmt = $pdo->execute("SELECT * FROM artists WHERE id = :id", ["id" => $artistId]);
    $name = $stmt->fetch(PDO::FETCH_ASSOC);

    error_log("POST artistId: " . $_POST['artistId']);
    if ($name) {
        echo json_encode($name);
    } else {
        echo json_encode(["error" => "Artist not found"]);
    }
} else {
    echo json_encode(["error" => "No artistId provided"]);
}
?>