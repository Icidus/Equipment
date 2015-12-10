<?php

// Define the core paths
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null :
define('SITE_ROOT', DS.'var'.DS.'www'.DS.'html'.DS.'cs'); 

//defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes');
defined('APP_PATH') ? null : define('APP_PATH', SITE_ROOT . DS . 'Application');

//Load Controllers
require_once(APP_PATH . DS . 'pdo.php');
require_once(APP_PATH . DS . 'user.php');

//Load required
date_default_timezone_set('America/New_York');



?>