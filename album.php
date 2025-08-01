<?php 
include("include/header.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
    exit();
}

$album = new Album($pdo, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?> songs</p>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php $songIdArray = $album->getSongIds(); 
        
        $i = 1;
        foreach($songIdArray as $songId) {
            // echo $songId . "<br>";

            $albumSong = new Song($pdo, $songId);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='tracklistRow'>
                    <div class='trackCount'>
						<img class='play' src='images/Play-white.png' onclick='setTrack(" . $albumSong->getId() . ", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <img class='optionsButton' src='images/more.png'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                </li>";

            $i++;
        }
        
        ?>

        <script>
            var tempSongIds = "<?php echo json_encode($songIdArray); ?>";   // Deze array bevat alle IDs van de liefdjes op die pagina waar je je bevindt. 
            tempPlaylist = JSON.parse(tempSongIds);
            console.log(tempPlaylist);
        </script>

    </ul>
</div>

<?php include("include/footer.php"); ?>