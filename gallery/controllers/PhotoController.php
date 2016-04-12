<?php

namespace gallery\controllers;

use gallery\components\SocialLinks;
use gallery\components\UserSession;
use gallery\models\MySQLDB;
use gallery\models\Picture;

/**
 * Class PhotoController
 * @package gallery\controllers
 */
class PhotoController extends BaseController
{
    public function execute($arguments = [])
    {

        if (!empty($_POST)) {
            if (isset($_POST['name']) && isset($_POST['text']) && isset($_POST['photoId'])) {
                MySQLDB::getInstance()->addComment($_POST['name'], $_POST['text'], $_POST['photoId']);
            }
        }

        $photo = MySQLDB::getInstance()->getPhoto(UserSession::getInstance()->username, $arguments[2]);
        $file = 'pictures/' . UserSession::getInstance()->username . '/' . $photo['uri'];

        if (isset($arguments['3']) == 'load') {
            if (file_exists($file)) {
                header([]);
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . $photo['description'] . '.jpg');
                readfile($file);
                exit;
            }
        }

        echo $this->render('photo.twig', [
            'username' => UserSession::getInstance()->username,
            'title' => 'Register',
            'photoId' => $photo['id'],
            'photoUri' => $photo['uri'],
            'photoDate' => Picture::formatDate($photo['date']),
            'photoDescription' => $photo['description'],
            'socialLinks' => SocialLinks::shareLinks("http://localhost/user/" . \gallery\components\UserSession::getInstance()->username . "/", $photo['description'], 'Extended page description', "http://localhost/user/" . \gallery\components\UserSession::getInstance()->username . "/photo/" . $photo['id'], '@twitterUser'),
            'photo' => $photo,
        ]);
        return true;
    }
}