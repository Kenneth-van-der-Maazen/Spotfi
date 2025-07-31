<?php 
include("include/header.php");


?>

<!-- ANNOUNCEMENTS BANNER -->

<!-- USER PLAYLISTS -->

<div class="madeForYou">
    <p>Made For</p>
    <!-- <h1 class="pageHeadingBig">[USERNAME]</h1> -->
    <h1 class="pageHeadingBig">
    <?php 
    if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === true && isset($_SESSION['user_name'])) {
        echo htmlspecialchars($_SESSION['user_name']);
    } else {
        echo "NOBODY";
    }
    ?>
</h1>
</div>

<div class="gridViewContainer">
    <?php
        require_once("include/database.php");
        $pdo = new Database();

        $stmt = $pdo->execute("SELECT * FROM albums ORDER BY RAND() LIMIT 10");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            echo '<div class="gridViewItem">
                <a href="album.php?id=' . $row['id'] . '">
                    <img src="' . $row['artworkPath'] . '">
                    <div class="gridViewInfo">' . $row['title'] . '</div>
                </a>
            </div>';
        }
    ?>
</div>

<!-- RECENTLY PLAYED -->

<?php include("include/footer.php"); ?>