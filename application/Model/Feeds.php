<?php
/**
 * Feeds Class
 * 
 * @package IntegracioFb\Application\Model\Feeds
 * @author Muhammad Adeel <muhammad_adeel91@yahoo.com>
*/

class Feeds extends Configuration
{
    public function __construct($base_url = null) {
        parent::__construct($base_url);
    }

    public static function get()
    {
        return 'success';
    }
}
