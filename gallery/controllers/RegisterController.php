<?php

namespace gallery\controllers;

use gallery\components\Router;
use gallery\components\UserSession;
use gallery\models\MySQLDB;

/**
 * Class RegisterController
 * @package gallery\controllers
 */
class RegisterController extends BaseController
{
    public function execute($arguments = [])
    {

        if (
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            isset($_POST['password-confirm']) &&
            !empty($_POST['username']) &&
            !empty($_POST['password'])
        ) {
            if ($_POST['password'] == $_POST['password-confirm']) {
                if (!MySQLDB::getInstance()->findUserName($_POST['username'])) {
                    MySQLDB::getInstance()->addUser($_POST['username'], $_POST['password']);
                    UserSession::getInstance()->login($_POST['username']);
                    Router::redirect('/');
                } else {
                    $error = "Failed: User already exists.";
                }
            } else {
                $error = "Failed: Password does not match.";
            }
        } else if (
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            isset($_POST['password-confirm'])
        ) {
            $error = "Failed: All fields is required.";
        }

        echo $this->render('register.twig', [
            'error' => isset($error) ? $error : false,
            'username' => isset($_POST['username']) ? $_POST['username'] : '',
            'title' => 'Register'
        ]);

        return true;
    }
}