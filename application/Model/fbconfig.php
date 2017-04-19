<?php

session_start();
// added in v4.0.0
require_once 'autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

// init app with app id and secret
FacebookSession::setDefaultApplication('1913342228944580', 'a3df6f1d2cdc053b302eb3fb06513eec');
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper('http://localhost:9002/fbconfig.php');
try {
    $session = $helper->getSessionFromRedirect();
} catch (FacebookRequestException $ex) {
    // When Facebook returns an error
} catch (Exception $ex) {
    // When validation fails or other local issues
}
// see if we have
//  a session
if (isset($session)) {
    // graph api request for user data
    $request = new FacebookRequest($session, 'GET', '/me', array(
        'fields' => 'email,name,birthday,gender'
    ));
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');
    $fbfullname = $graphObject->getProperty('name');
    $femail = $graphObject->getProperty('email');
    $fbirthday = $graphObject->getProperty('birthday');
    $fgender = $graphObject->getProperty('gender');
    /* ---- Session Variables ----- */
    $_SESSION['FBID'] = $fbid;
    $_SESSION['USERNAME'] = $fbfullname;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] = $femail;
    $_SESSION['BIRHTDAY'] = $fbirthday;
    $_SESSION['GENDER'] = $fgender;
    /* ---- header location after session ---- */

    /* ---- Retrieve Facebook Album ---- */
    $albumRequest = new FacebookRequest(
            $session, 'GET', '/me/albums', array(
        'fields' => 'photos{images}'
            )
    );

    $albumResponse = $albumRequest->execute();
    $albumGraphObject = $albumResponse->getGraphObject();
    $albums = $albumGraphObject->getProperty('data')->asArray();

    $_SESSION['ALBUM'] = [];
    foreach ($albums as $key => $album) {
        $albumProperty = $album->photos->data[0];
        $_SESSION['ALBUM'][$albumProperty->id] = $albumProperty->images[7]->source;
    }
    /* ---- Retrieve Facebook Album ---- */

    /* ---- Retrieve Facebook Feeds ---- */
    $feedRequest = new FacebookRequest(
            $session, 'GET', '/me', array(
        'fields' => 'feed{message,picture,created_time}'
            )
    );

    $feedResponse = $feedRequest->execute();
    $feedGraphObject = $feedResponse->getGraphObject();
    $_SESSION['FEEDS'] = $feedGraphObject->getProperty('feed')->getProperty('data')->asArray();
    /* ---- Retrieve Facebook Feeds ---- */

    /* ---- Retrieve Facebook Videos ---- */
    $videosRequest = new FacebookRequest(
            $session, 'GET', '/me/videos/uploaded', array(
        'fields' => 'created_time,source'
            )
    );

    $videosResponse = $videosRequest->execute();
    $videosGraphObject = $videosResponse->getGraphObject();
    $_SESSION['VIDEOS'] = $videosGraphObject->getProperty('data')->asArray();
    /* ---- Retrieve Facebook Videos ---- */

    header("Location: index.php");
} else {
    $loginUrl = $helper->getLoginUrl();
    header("Location: " . $loginUrl);
}
?>