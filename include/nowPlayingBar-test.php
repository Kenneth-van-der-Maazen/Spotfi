<?php
require_once("database.php");
$pdo = new Database();


$songQuery = $pdo->execute("SELECT * FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = $songQuery->fetch(PDO::FETCH_ASSOC)) {
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>


<script>

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

$(document).ready(function() {
    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
        e.preventDefault();
    });

    $(".playbackBar .progressBar").mousedown(function() {
        mouseDown = true;
    });

    $(".playbackBar .progressBar").mousemove(function(e) {
        if(mouseDown == true) {
            // stel de tijd in op basis van waar de muis is
            timeFromOffset(e, this);
        }
    });

    $(".playbackBar .progressBar").mouseup(function(e) {
        timeFromOffset(e, this);
    });


     $(".volumeBar .progressBar").mousedown(function() {
        mouseDown = true;
    });

    $(".volumeBar .progressBar").mousemove(function(e) {
        if(mouseDown == true) {
            
            var percentage = e.offsetX / $(this).width();

            if(percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
            
        }
    });

    $(".volumeBar .progressBar").mouseup(function(e) {
         var percentage = e.offsetX / $(this).width();

        if(percentage >= 0 && percentage <= 1) {
            audioElement.audio.volume = percentage;
        }
    });


    $(document).mouseup(function() {
        mouseDown = false;
    });


});

function timeFromOffset(mouse, progressBar) {
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
}

function prevSong() {
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex = currentIndex - 1;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function nextSong() {

    if(repeat == true) {
        audioElement.setTime(0);
        playSong();
        return;
    }

    if(currentIndex == currentPlaylist.length - 1) {
        currentIndex = 0;
    } else {
        currentIndex++;
    }

    var trackToPlay = currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}



function setRepeat() {
    repeat = !repeat;
    var imageName = repeat ? "Repeat.png" : "Repeat-off.png"
    $(".controlButton.repeat img").attr("src", "images/" + imageName);
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "mute.png" : "volume.png"
    $(".controlButton.volume img").attr("src", "images/" + imageName);
}

function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? "Shuffle.png" : "Shuffle-off.png"
    $(".controlButton.shuffle img").attr("src", "images/" + imageName);
}


function setTrack(trackId, newPlaylist, play) {
    if (newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }


    
    // currentIndex = currentPlaylist.indexOf(trackId);
    currentIndex = shuffle ? shufflePlaylist.indexOf(trackId) : currentPlaylist.indexOf(trackId);
    pauseSong();

    $.post("include/ajax/getSongJson.php", { songId: trackId }, function(data) {
        var track = JSON.parse(data);
        $(".trackName span").text(track.title);
        
        $.post("include/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
            var artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
        });

        $.post("include/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
            var album = JSON.parse(data);
            $(".albumLink img").attr("src", album.artworkPath);
        });

        audioElement.setTrack(track);

        if(play === true) {
            playSong();
        }

    });

    
}

function playSong() {
    if(audioElement.audio.currentTime == 0) {
        $.post("include/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
    } 

    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.audio.play();
    // audioElement.play();
}

function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.audio.pause();
}

// console.log();
</script>

<?php if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === true): ?>
<div id="nowPlayingBarContainer">

    <div class="nowPlayingBar">

        <div class="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img src="" class="albumArtwork">
                </span>

                <div class="trackInfo">
                    <span class="trackName">
                        <span></span>
                    </span>

                    <span class="artistName">
                        <span></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
                        <img src="images/shuffle-48.png" alt="Shuffle">
                    </button>

                    <button class="controlButton previous" title="Previous button" onclick="prevSong()">
                        <img src="images/rewind-48.png" alt="Previous">
                    </button>

                    <button class="controlButton play" title="Play button" onclick="playSong()">
                        <img src="images/play-48.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause button" style="display: none !important;" onclick="pauseSong()">
                        <img src="images/pause-48.png" alt="Pause">
                    </button>

                    <button class="controlButton next" title="Next button" onclick="nextSong()">
                        <img src="images/forward-48.png" alt="Next">
                    </button>

                    <button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
                        <img src="images/Repeat-off.png" alt="Repeat">
                    </button>
                </div>

                <div class="playbackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
                </div>
            </div>
        </div>

        <div class="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume" onclick="setMute()">
                    <img src="images/volume.png" alt="Volume">
                </button>

                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>