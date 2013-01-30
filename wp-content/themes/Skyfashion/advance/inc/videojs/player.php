<?php
$width = $_GET['w'];
$height = $_GET['h'];
$src = $_GET['src'];
$ext = parse_url($src, PHP_URL_PATH);
$ext = pathinfo($ext, PATHINFO_EXTENSION);
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>HTML5 Video Player</title>
    <!-- Include the VideoJS Library -->
    <script src="video.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        // Must come after the video.js library
        // Add VideoJS to all video tags on the page when the DOM is ready
        VideoJS.setupAllWhenReady();
        /* ============= OR ============ */
        // Setup and store a reference to the player(s).
        // Must happen after the DOM is loaded
        // You can use any library's DOM Ready method instead of VideoJS.DOMReady
        /*
        VideoJS.DOMReady(function(){
          // Using the video's ID or element
          var myPlayer = VideoJS.setup("example_video_1");
          // OR using an array of video elements/IDs
          // Note: It returns an array of players
          var myManyPlayers = VideoJS.setup(["example_video_1", "example_video_2", video3Element]);
          // OR all videos on the page
          var myManyPlayers = VideoJS.setup("All");
          // After you have references to your players you can...(example)
          myPlayer.play(); // Starts playing the video for this player.
        });
        */
        /* ========= SETTING OPTIONS ========= */
        // Set options when setting up the videos. The defaults are shown here.
        /*
        VideoJS.setupAllWhenReady({
          controlsBelow: false, // Display control bar below video instead of in front of
          controlsHiding: true, // Hide controls when mouse is not over the video
          defaultVolume: 0.85, // Will be overridden by user's last volume if available
          flashVersion: 9, // Required flash version for fallback
          linksHiding: true // Hide download links when video is supported
        });
        */
        // Or as the second option of VideoJS.setup
        /*
        VideoJS.DOMReady(function(){
          var myPlayer = VideoJS.setup("example_video_1", {
            // Same options
          });
        });
        */
    </script>
    <!-- Include the VideoJS Stylesheet -->
    <link rel="stylesheet" href="video-js.css" type="text/css" media="screen" title="Video JS">
</head>
<body>
<?php
//	echo $width;
//	echo $height;
//	echo $src;
//	echo $ext;
//	print_r($_GET);
//	echo "Ssos";
?>
<!-- Begin VideoJS -->
<div class="video-js-box">
    <!-- Using the Video for Everybody Embed Code http://camendesign.com/code/video_for_everybody -->
    <video id="example_video_1" class="video-js" width="<?php echo $width; ?>" height="<?php echo $height; ?>" controls="controls" preload="auto">
        <?php if ($ext == 'mp4'): ?>
        <source src="<?php echo $src; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'/>
        <?php elseif ($ext == 'webm'): ?>
        <source src="<?php echo $src; ?>" type='video/webm; codecs="vp8, vorbis"'/>
        <?php elseif ($ext == 'ogv'): ?>
        <source src="<?php echo $src; ?>" type='video/ogg; codecs="theora, vorbis"'/>
        <?php endif; ?>
        <!-- Flash Fallback. Use any flash video player here. Make sure to keep the vjs-flash-fallback class. -->
        <object id="flash_fallback_1" class="vjs-flash-fallback" width="<?php echo $width; ?>" height="<?php echo $height; ?>" wmode="transparent" type="application/x-shockwave-flash"
                data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
            <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf"/>
            <param name="allowfullscreen" value="true"/>
            <param name="flashvars" value='config={"playlist":[{"url": "<?php echo $src; ?>","autoPlay":false,"autoBuffering":true}]}'/>
            <param name="wmode" value="transparent">
        </object>
    </video>
    <p class="vjs-no-video">
        <!-- Download links provided for devices that can't play video in the browser. -->
        <a href="http://video-js.zencoder.com/oceans-clip.mp4">Download Video</a>,
        <!-- Support VideoJS by keeping this link. -->
        <a href="http://videojs.com">HTML5 Video Player</a> by VideoJS
    </p>
</div>
<!-- End VideoJS -->
</body>
</html>