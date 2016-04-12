<?php
namespace gallery;

use gallery\components;
use gallery\models\MySQLDB;

require_once 'vendor/autoload.php';
require_once 'components/Router.php';
require_once 'components/UserSession.php';
require_once 'controllers/BaseController.php';
require_once 'components/Pagination.php';

require_once 'models/Picture.php';
require_once 'models/FileDB.php';
require_once 'models/MySQLDB.php';
require_once 'components/SocialLinks.php';

$mysqlConf = require_once 'mysql.php';
MySQLDB::init($mysqlConf['dbName'], $mysqlConf['host'], $mysqlConf['user'], $mysqlConf['password']);

$router = new components\Router($_SERVER['REQUEST_URI']);

if (!$router->handle()) {
    echo 'Path not found.';
}