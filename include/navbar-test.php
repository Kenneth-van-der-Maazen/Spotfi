<?php



?>

<!-- NAVBAR TOP -->
<div class="wp7mZFPzV7Qmo51F0NA_ header-top global-nav-bar" id="global-nav-bar">

    <div class="pIM9jg__39NIpOvXG89b header-icon-container nav-bar-icon nav-bar-left">
        <a class="main-icon" href="/">
            <img class="logo" src="images/logo-48.png" alt="Logo">
        </a>
    </div>

    <div class="gj5VcIUC9oD2p4BsxzGE header-icon nav-bar-icon nav-bar-center">
        <div class="lj0eGI6WEtfxFX7irC03 center-items-container">
            <button class="navbar-home-btn AonZ39aVKATRTjY28Uww" aria-label="Home">
                <span aria-hidden="true" class="icon icon-home-btn">
                    <img class="icon-home" src="images/home-icon.png" alt="Home Icon">
                </span>
            </button>
            <div class="_b3hhmbWtOY8_1M1mM1H nav-bar-src-container">
                <form class="b7r2WRiu5f9Q99qmyreh src-container form-input-icon" role="search">
                    <div class="form-input-icon__icon">
                        <div>
                            <button class="src-button" aria-label="Search"></button>
                            <img class="src-btn-icon" src="images/search-icon.png" alt="Search Icon">
                        </div>
                    </div>
                    <div class="ODl7TwNawIfBwiZv1Czg src-input">
                        <input class="form-input" id="formInput" aria-label="What do you want to play?" type="search" placeholder="What do you want to play?" tabindex="0">
                        <div class="dM_TEJo05MxBvrLzfNrW form-input-text" aria-hidden="true">
                            <span class="upGmCR5y3yDImbt6sHOl input-text">What do you want to play?</span>
                            <!-- <span class="input-text"></span> -->
                        </div>
                    </div>
                    <div class="form-input-icon__icon">
                        <div class="BV0jjn_h5TtMMl8YKuZ0 form-input-icon-container">
                            <button class="browse-btn" aria-label="Browse">
                                <span aria-hidden="true" class="icon icon-wrapper">
                                    <img class="icon-img" src="images/browse-icon.png" alt="Browse Icon">
                                </span>
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <div class="N9r2VuXMBlhRSVF5dCek header-icon nav-bar-icon nav-bar-right">
        <div class="VUXMMFKWudUWE1kIXZoS navbar-container-right">
            <button class="Button-sc navbar-links">Github</button>
            <button class="Button-sc navbar-links">LinkedIn</button>
            <button class="Button-sc navbar-links">About</button>
            
            <div class="k0vXhOdr0XE83lAQaJ1O navbar-right-spacing"></div>
            
            <a class="Button-sc source-download" href="/download">
                <span class="icon icon-download button__icon-wrapper">
                    <img class="icon-download-img" src="images/download-icon2.png" alt="Download Icon">
                </span>
                <span class="source-download-text">Download Source</span>
            </a>

        <?php if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === true): ?>
            <div class="user-dropdown">
                <button class="dropdown-toggle" aria-label="User Menu">
                    <img src="<?= htmlspecialchars($_SESSION['profile_pic'] ?? 'images/default-profile.png') ?>" 
                        alt="Profile Picture" 
                        style="width: 40px; height: 40px; border-radius: 50%;">
                </button>
                <div class="dropdown-menu">
                    <a href="user/profile.php" class="dropdown-item">Profile</a>
                    <a href="user/settings.php" class="dropdown-item">Settings</a>
                    <hr>
                    <a href="user/user-logout.php" class="dropdown-item">Logout</a>
                </div>
            </div>

        <?php else: ?>
            <button><a href="user/user-register.php">Sign up</a></button>
            <button><a href="user/user-login.php">Login</a></button>
        <?php endif; ?>


        </div>
    </div>
</div>