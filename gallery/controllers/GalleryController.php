<?php

namespace gallery\controllers;

use gallery\components\Router;
use gallery\components\UserSession;
use gallery\models\MySQLDB;

/**
 * Class GalleryController
 * @package gallery\controllers
 */
class GalleryController extends BaseController
{
    public function execute($arguments = [])
    {
        if (UserSession::getInstance()->isGuest) {
            Router::redirect('/');
        }

        $perPage = 5;

        if (isset($arguments[2])) {
            $tempPP = $arguments[2];
            if ($tempPP == "pp5") {
                $perPage = 5;
            } elseif ($tempPP == "pp10") {
                $perPage = 10;
            } elseif ($tempPP == "pp100") {
                $perPage = 10000;
            }
        }

        $postCount = MySQLDB::getInstance()->PostCount(UserSession::getInstance()->username);

        $page = 1;
        if (isset($arguments[2]) && is_numeric($arguments[2])) {
            $page = $arguments[2];
        }

        $photos = MySQLDB::getInstance()->getPhotos(UserSession::getInstance()->username, $page, $perPage);
        $username = UserSession::getInstance()->username;

        require_once 'views/parts/header.php';

        require_once 'views/gallery.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}

