<?php
require_once __DIR__ . '../../../autoload.php';
require_once __DIR__ . '../../Model/Configuration.php';
require_once __DIR__ . '../../Model/FacebookRequest.php';

$configuration = new Configuration();
$facebookRequest = new FacebookRequest();
?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title>Login with Facebook</title>
        <link href="<?php echo $configuration->getBaseUrl() . '/public/css/style.css'; ?>" rel="stylesheet">
        <script src="<?php echo $configuration->getBaseUrl() . '/public/js/bootstrap.min.js'; ?>"></script>
    </head>
    <body>
        <div class="container container-table">
            <div class="row vertical-center-row">
                <div class="text-center main-container">
                    <h1>Findora</h1>
                    <h3>Adding new friends will never be the same again</h3>
                    <h5>Findora is building the largest network of friends.</h5>
                    <a class="defaultBtn" href="<?php echo $facebookRequest->getLogin(); ?>">Login with Facebook</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footerContent">Designed and Developed by Muhammad Sajeel</div>
        </div>
    </body>
</html>