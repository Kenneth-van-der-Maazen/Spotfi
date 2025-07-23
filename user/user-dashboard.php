<?php
session_start();
require '../include/user-class.php';

$user = new User();
$user_id = $_SESSION['user_id'] ?? null;

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    // Geen user ingelogd.
    echo "User not found!";
    echo "<a href='user-login.php'>Login</a>";
}

$user_data = $user->getUserById($user_id);
if (!$user_data) {
    echo "<p class='text-danger'>No user with ID was found..</p>";
    exit();
} else {
  $_SESSION['user_name'] = $user_data['user_name'];
}



// 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SpotLite</title>

    <link rel="icon" type="image/x-icon" href="../images/SoundCloud.ico">

    <link rel="stylesheet" type="text/css" href="../css/user-dashboard.css">
</head>
<body>
    <div class="sidebar text-center">
        <div class="user-info">
            <div class="user-img">
                <!-- USER MOET PROFIEL FOTO KUNNEN AANPASSEN -->
                <?php if (!empty($user_data['profile_picture'])): ?>
                    <img src="<?= htmlspecialchars($user_data['profile_picture']) ?>" alt="Profielfoto" class="profile-img mb-3">
                <?php else: ?>
                    <img src="../images/default-profile.png" alt="Profielfoto" class="profile-img mb-3">
                <?php endif; ?>
            </div>

            <div class="user-text">
                <p>Profile</p>
                <h2><?= htmlspecialchars($user_data['user_name']) ?></h2>
                <!-- <p>Role: <?= htmlspecialchars($user_data['rol']) ?></p> -->
                <p for="email">Joined: <?= date('d-m-Y', strtotime(htmlspecialchars($user_data['reg_date']))) ?></p>
            </div>
        </div>



    <!-- <a href="user-logout.php" class="logout-btn">Log out</a>
    <br>
    <a href="../index.php" class="btn btn-primary">🔸 Return Home</a> -->

    <div class="section user-dashboard">
        <!-- <button class="dots"><span></span></button> -->
        <div class="dropdown-wrapper">
            <button class="dots" id="dotsBtn"><span></span></button>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="edit-profile.php">
                    <img src="../images/Edit-Pencil.png" alt="Edit profile" class="dropdown-icons">    
                    Edit profile
                </a>
                <a href="../index.php">
                    <img src="../images/Home.png" alt="Edit profile" class="dropdown-icons"> 
                    Return home
                </a>
                <a href="user-logout.php">
                    <img src="../images/Logout.png" alt="Edit profile" class="dropdown-icons"> 
                    Logout
                </a>
            </div>
        </div>

        <div class="topArtistsContainer">
            <div class="topArtistsContent">
                <a href="#" class="topArtistsLink">
                <h2 class="topArtists-h2">Top artists this month</h2>
                </a>
                <p>Only visible to you</p>

            </div>
        </div>

        <div class="topTracksContainer">
            <div class="topTracksContent">
                <a href="#" class="topTracksLink">
                <h2 class="topArtists-h2">Top tracks this month</h2>
                </a>
                <p>Only visible to you</p>
            </div>
        </div>
    </div>
    <!-- </div> -->

<script>
    const dotsBtn = document.getElementById('dotsBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dotsBtn.addEventListener('click', () => {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Optioneel: sluit menu als je ergens anders klikt
    window.addEventListener('click', (e) => {
        if (!dotsBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>
</body>
</html>