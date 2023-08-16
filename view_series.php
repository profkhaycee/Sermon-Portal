<?php 
$page_title ='View Series';

include 'header.php';

if (isset($_REQUEST['id'])) {

    $id=$_REQUEST['id'];
    
}
?>


	<!-- Live Stream Start -->

<section class="gap no-bottom live-stream">

    <div class="container">

        <div class="heading">

            <img src="assets/images/listen-sermon-2.png" width="60" height="80" alt="Heading Image 2">

            <p></p>

            <h3><?php echo $action->getSeriesTitle($id) ; ?></h3>

        </div>
        <div class="testt">
            <?php $list = $action->fetchMessagesBySeries($id); ?>
        </div>

        <div class="row">

            <div class="audio-player">

                <audio id="myAudio" ontimeupdate="onTimeUpdate()">

                    <!-- <source src="audio.ogg" type="audio/ogg"> -->

                    <source id="source-audio" src="assets/music/audio-1.mp3" type="audio/mpeg">

                    Your browser does not support the audio element.

                </audio>



                <div class="player-ctn" data-aos="fade-up" data-aos-duration="1000">

                    <div class="audio-run">

                    <div class="parallax" style="background-image: url(assets/images/Picture1.jpg);"></div>

                        <div class="btn-ctn">

                            <div class="btn-action first-btn next-prev" onclick="previous()">

                            <div id="btn-faws-back">

                                <i class='fas fa-step-backward'></i>

                            </div>

                            </div>

                            <div class="btn-action" onclick="toggleAudio()">

                            <div id="btn-faws-play-pause">

                                <i class='fas fa-play' id="icon-play"></i>

                                <i class='fas fa-pause' id="icon-pause" style="display: none"></i>

                            </div>

                            </div>

                            <div class="btn-action next-prev" onclick="next()">

                            <div id="btn-faws-next">

                                <i class="fas fa-step-forward" aria-hidden="true"></i>

                            </div>

                            </div>

                            <div class="btn-mute" id="toggleMute" onclick="toggleMute()">

                            <div id="btn-faws-volume">

                                <i id="icon-vol-up" class='fas fa-volume-up'></i>

                                <i id="icon-vol-mute" class='fas fa-volume-mute' style="display: none"></i>

                            </div>

                            </div>

                        </div>

                        <div class="infos-ctn">

                        <div class="timer">00:00</div>

                        <div class="title"></div>

                        <div class="duration">00:00</div>

                    </div>

                        <div id="myProgress">

                        <div id="myBar"></div>

                        </div>

                    </div>

                    <div class="playlist-ctn" data-aos="fade-up" data-aos-duration="1500"></div>

                </div>

            </div>

        </div>

        <div class="d-flex justify-content-center loadmore">

            <a href="JavaScript:void(0)" class="theme-btn">View All Playlist</a>

        </div>

    </div>

</section>

	<!-- Live Stream End -->


<script>
    var listAudio = <?= $list ?>;
    console.log(listAudio)
</script>
<?php
include 'footer.php';
?>