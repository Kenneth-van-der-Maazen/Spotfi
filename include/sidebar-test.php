<?php

?>
<div class="navBarContainer">
    <nav class="navBar">
        <!-- <a href="index.php" class="logo">
            <img src="images/logo-96.png" alt="Logo">
        </a> -->
        <?= $profileHTML ?>
        

        <div class="group">
            <div class="navItem">
                <a href="index.php" class="navItemLink">
                    <img src="images/home-32.png" alt="Home" class="icon">
                    <span class="navItemText">Home</span>
                </a>
            </div>

            <div class="navItem">
                <a href="search.php" class="navItemLink">
                    <img src="images/search-48.png" alt="Seatch" class="icon">
                    <span class="navItemText">Search</span>
                </a>
            </div>
        </div>

        <div class="group">
            <div class="navItem">
                <!-- <img src="images/music-50.png" alt="Library" class="icon"> -->
                <span class="navItemText">Your Library</span>
            </div>

            <div class="navItem">
                <a href="browse.php" class="navItemLink">Playlist #01</a>
            </div>

            <div class="navItem">
                <a href="music.php" class="navItemLink">Podcasts</a>
            </div>

            <div class="navItem">
                <a href="user/user-dashboard.php" class="navItemLink">[ DASHBOARD ]</a>
            </div>

        </div>

    </nav>
</div>