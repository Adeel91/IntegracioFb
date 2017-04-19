<?php
session_start();
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title>Login with Facebook</title>
        <link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> 
    </head>
    <body>
        <?php if ($_SESSION['FBID']): ?>      <!--  After user login  -->
            <div class="container">
                <div class="hero-unit">
                    <h1 style="color:red;">Hello <?php echo $_SESSION['USERNAME']; ?></h1>
                    <p style="color:black;">Welcome to "FACEBOOK LOGIN" tutorial</p>
                    <div><a href="logout.php">Logout</a></div>
                </div>
                <div class="span4" style="width:45%;float:left">
                    <ul class="nav nav-list">
                        <li class="nav-header">Display Picture</li>
                        <li><img src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture"></li>

                        <li class="nav-header">Facebook ID</li>
                        <li><?php echo $_SESSION['FBID']; ?></li>

                        <li class="nav-header">Username</li>
                        <li><?php echo $_SESSION['FULLNAME']; ?></li>

                        <li class="nav-header">Email</li>
                        <li><?php echo $_SESSION['EMAIL']; ?></li>

                        <li class="nav-header">Birthday</li>
                        <li><?php echo $_SESSION['BIRHTDAY']; ?></li>

                        <li class="nav-header">Gender</li>
                        <li><?php echo $_SESSION['GENDER']; ?></li>

                        <li class="nav-header">Facebook User's Album / Pictures</li>
                        <li>
                            <?php foreach ($_SESSION['ALBUM'] as $picture) { ?>
                                <img src="<?php echo $picture; ?>" />
                            <?php } ?>
                        </li>

                        <li class="nav-header">Facebook User's Videos</li>
                        <?php foreach ($_SESSION['VIDEOS'] as $video) { ?>
                            <li>
                                <video id="fb_video_<?php echo $video->id; ?>" src="<?php echo $video->source; ?>" controls></video>
                                <p><?php echo $video->created_time; ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="span4" style="float: right; width:45%">
                    <ul class="nav nav-list">
                        <li class="nav-header"><h1>News Feed</h1></li>
                    </ul>
                    <?php
                    $index = 1;
                    foreach ($_SESSION['FEEDS'] as $feed) {
                        ?>
                        <ul style="border-bottom: 1px solid #ccc; padding: 10px 20px; list-style: none">
        <?php if (isset($feed->message)) { ?>
                                <li class="nav-header">News Feed <?php echo $index; ?></li>
                                <li>
                                    <h6><?php echo $feed->message; ?></h6>
                                    <p><?php echo $feed->created_time; ?></p>
                                </li>
        <?php } else if (isset($feed->picture)) { ?>
                                <li class="nav-header">News Feed <?php echo $index; ?></li>
                                <li>
                                    <img src="<?php echo $feed->picture; ?>" />
                                    <p><?php echo $feed->created_time; ?></p>
                                </li>
                        <?php } ?>
                        </ul>
                        <?php
                        $index++;
                    }
                    ?>
                </div>
            </div>
<?php else: ?>     <!-- Before login --> 
            <div class="container">
                <h1 style="background-color:green; color:white;">Login with Facebook</h1>
                It Is Not Connected. Kindly Login
                <div>
                    <a href="fbconfig.php">Login with Facebook</a></div>
            </div>
<?php endif ?>
    </body>
</html>