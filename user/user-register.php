<?php
include '../include/user-class.php';

$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $user = new User();

        $user->registerUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['user_name'], $_POST['password'], $_POST['confirm_password']);
        // echo "New user registered successfully!";
        $succesMessage = "New account registered!";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SpotLite</title>

    <!-- <link rel="stylesheet" type="text/css" href="../css/main.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body class="register-page">
    <section class="user-register-page">
        <div class="user-register-container">
            <!-- <h2>Sign up to listen!</h2> -->
            <form class="registerForm" method="POST">
                <h2>Register a new account</h2>

                <?php if (!empty($succesMessage)): ?>
                    <div class="success-message" style="color: green; margin-bottom: 20px;">
                        <?= htmlspecialchars($succesMessage) ?>
                    </div>
                <?php endif; ?>

                <p>
                    <label for="first_name">First name</label>
                    <input class="reg-first_name" type="text" name="first_name" placeholder="First Name" required>
                </p>
                <p>
                    <label for="last_name">Last name</label>
                    <input class="reg-last_name" type="text" name="last_name" placeholder="Last Name" required>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input class="reg-email" type="email" name="email" placeholder="Email" required>
                </p>
                <p>
                    <label for="user_name">Username</label>
                    <input class="reg-user_name" type="text" name="user_name" placeholder="Username" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input class="reg-password" type="password" name="password" placeholder="Password" required>
                </p>
                <p>
                    <label for="confirm_password">Password again</label>
                    <input class="reg-confirm_password" type="password" name="confirm_password" placeholder="Confirm Password" required>
                </p>
                
                <button type="submit" name="Register" value="Register">REGISTER</button>

                <div class="hasAccountText">
                    <span class="hideRegister">Already have an account? <a href="user-login.php">[ Login here ]</a></span>
                </div>
            </form>

            <div class="registerText">
                <h1>Register today!</h1>
                <h2>And don't miss out on new music!</h2>
                <p>By registering, you agree to our <a href="#">Terms of Service</a></p>
            </div>
            <!-- <p>Already have an account? <a href="user-login.php"> [ Login here ]</a></p> -->
            <!-- <a href="../index.php">< Go back</a> -->
        </div>
    </section>
</body>
</html>