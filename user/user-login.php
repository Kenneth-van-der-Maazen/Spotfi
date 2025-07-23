<?php
session_start();
require "../include/user-class.php";

$sql = new User();
$errorMessage = "";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $sql->login($_POST['user_name']);
        

        if ($login && password_verify($_POST['password'], $login['password'])) {
            
            $_SESSION['login_status'] = true;
            $_SESSION['user_id'] = $login['user_id'];
            $_SESSION['user_name'] = $login['user_name'];
            $_SESSION['profile_pic'] = $login['profile_pic'] ?? null;
            

            // echo "Hello, " . $login['user_name'] . "!";
            $successMessage = "Success!";
            header("refresh:2, url = ../index.php");
        } else {
            // Foutmelding links bovenin het scherm.
            // echo "<span class='errorMessage' style='color: red !important'>TEST ERROR</span>";
            $errorMessage = "Invalid username or password.";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SpotLite</title>

    <!-- <link rel="stylesheet" type="text/css" href="../css/main.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body class="login-page">
    <section class="user-login-page">
        <div class="user-login-container">
            <!-- <h2>Login to SpotLite</h2> -->

            <form class="loginForm" method="POST">
                <h2>Login to your account</h2>

                <p>
                    <label for="user_name">Username or Email</label>
                    <input class="loginUsername" type="text" name="user_name" placeholder="Username" required>
                </p>
                <p>
                    <label for="loginPassword">Password</label>
                    <input class="loginPassword" type="password" name="password" placeholder="Your password" required>
                </p>

                <?php if (!empty($errorMessage)): ?>
                <div class="error-message" style="color: red !important; margin-bottom: 20px;">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($successMessage)): ?>
                <div class="success-message" style="color: green !important; margin-bottom: 20px;">
                    <?= htmlspecialchars($successMessage) ?>
                </div>
                <?php endif; ?>
                
                <button type="submit" value="Login" name="Login">LOG IN</button>

                <div class="hasAccountText">
                    <span class="hideLogin">Don't have an account yet? <a href="user-register.php">[ Sign up here ]</a></span>
                </div>
            </form>

            
            <!-- <a href="../index.php">< Go back</a> -->
            <div class="loginText">
                <h1>My Music Box.</h1>
                <h2>Made it with:</h2>
                <ul>
                    <li>HTML & CSS</li>
                    <li>PHP & MySQL<li>
                    <li>JavaScript</li>
                    <li>AJAX</li>
                </ul>
            </div>

        </div>
    </section>

    <footer>
        <div class="footer-container">
            <p class="encore-text">Kenneth van der Maazen (C) 2025 - I took an online course for this, and elements from Spotify and applied my PDO-Expert skills. [23/07/2025 - 14:26] BEST VERSION</p>
        </div>
    </footer>
