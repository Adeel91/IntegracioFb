<?php
/**
 * Main Configuration Class
 * 
 * @package IntegracioFb\Application\Model\Configuration
 * @author Muhammad Adeel <muhammad_adeel91@yahoo.com>
*/

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

class Configuration 
{
    /**#@
     * @var string
     */
    const FB_API_KEY = '1913342228944580';
    const FB_API_SECRET = 'a3df6f1d2cdc053b302eb3fb06513eec';
    
    /**
     * @var string 
     */
    protected $base_url;

   /**
    * Class constructor
    * @param string $base_url
    */
    public function __construct($base_url = null)
    {
        $this->base_url = 'http://' . $_SERVER['HTTP_HOST'];
    }
    
    /**
     * @return FacebookRedirectLoginHelper $helper
     */
    public function setFacebookSession()
    {
        // init app with app id and secret
        FacebookSession::setDefaultApplication(static::FB_API_KEY, static::FB_API_SECRET);
        // login helper with redirect_uri
        $helper = new FacebookRedirectLoginHelper('http://localhost:9002/application/Model/fbconfig.php');
        
        try {
            $session = $helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch (Exception $ex) {
            // When validation fails or other local issues
        }
        
        return $session;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }
}
