<?php
session_start();
include("include/user-class.php");
include("include/Classes/Artist.php");
include("include/Classes/Album.php");
include("include/Classes/Song.php");

// if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
//     header("Location: user/user-login.php");
//     exit;
// }


$user = new User();

$profileHTML = "";

if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === true && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_data = $user->getUserInfo($user_id);

    if ($user_data && isset($user_data['user_name'])) {
        $username = htmlspecialchars($user_data['user_name']);
        $profilePic = !empty($user_data['profile_pic']) ? htmlspecialchars($user_data['profile_pic']) : "images/default-profile.png";

        $profileHTML = "
            <div class='navProfile'>
                
                <img src='{$profilePic}' alt='Profile Picture' class='profilePic'>
                <div class='profileInfo'>
                    <span class='profileName'>{$username}</span>
                    <a href='user/user-dashboard.php' class='profileLink'>View profile</a>
                </div>
            </div>
        ";
    } 
} else {
    $profileHTML = "
        <div class='noProfile'>
            <a href='user/user-login.php' class='loginLink'>
                <img src='images/Default-Profile.png' alt='Default Picture' class='defaultProfilePic'>
                <span>Login to view your profile</span>
            </a>
        </div>
    ";
}

if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == true && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $user_data = $user->getUserInfo($user_id);
    if (!$user_data) {
        echo "User not found!";
    } elseif (!isset($user_data['user_name'])) {
        echo "User data is incomplete.";
    } else {
        echo "Welcome, " . htmlspecialchars($user_data['user_name']) . "!";
        // echo "<pre>";
        // print_r($user_data);
        // echo "</pre>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | SpotLite</title>

    <link rel="icon" type="image/x-icon" href="images/SoundCloud.ico">

    <link rel="stylesheet" type="text/css" href="css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>


<div class="mainContainer">

    <div class="topContainer">
        <?php include("include/navBarContainer.php"); ?>

        <div class="mainViewContainer">
            <div id="mainContent">