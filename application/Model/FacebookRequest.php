<?php
/**
 * Feeds Class
 * 
 * @package IntegracioFb\Application\Model\Feeds
 * @author Muhammad Adeel <muhammad_adeel91@yahoo.com>
*/

class FacebookRequest extends Configuration
{    
    public function __construct($base_url = null) {
        parent::__construct($base_url);
    }

    public function getLogin()
    {
        return $this->setFacebookSession();
    }
}
