<?php

namespace gallery\components;

/**
 * Class Router
 * @package gallery\components
 */
class Router
{
    private $uri;
    private $routes = [
        '/^\/$/' => 'IndexController',
        '/^\/index$/' => 'IndexController',
        '/^\/user\/([A-Za-z0-9]+)$/' => 'GalleryController',
        '/^\/user\/([A-Za-z0-9]+)\/([0-9a-z]+)\/$/' => 'GalleryController',
        '/^\/signup$/' => 'RegisterController',
        '/^\/photo$/' => 'AddPhotoController',
        '/^\/userzip$/' => 'ZipController',
        '/^\/user\/([A-Za-z0-9]+)\/photo\/(\d+)\/([a-z]+)/' => 'PhotoController',
        '/^\/user\/([A-Za-z0-9]+)\/photo\/(\d+)/' => 'PhotoController',
        '/^\/photoDel$/' => 'DeletePhotoController',
        '/^\/photoDel\/([0-9]+)\/$/' => 'DeletePhotoController'
    ];

    /**
     * Router constructor.
     * @param $requestUri
     */
    public function __construct($requestUri)
    {
        $this->uri = $requestUri;
    }

    /**
     * @return bool
     */
    public function handle()
    {
        foreach ($this->routes as $key => $value) {
            $matches = [];
            if (preg_match($key, $this->uri, $matches)) {
                if (!class_exists($value)) {
                    $controllerPath = 'controllers/' . $value . '.php';
                    if (file_exists($controllerPath)) {
                        require_once 'controllers/' . $value . '.php';
                    } else {
                        return false;
                    }
                }

                $value = '\gallery\controllers\\' . $value;

                $controller = new $value();
                return $controller->execute($matches);
            }
        }

        $matches = [];
        if (preg_match('/^\/(.+)/', $this->uri, $matches)) {

            $matches = explode('/', $matches[1]);
            $controller = ucfirst($matches[0]) . 'Controller';
            if (!class_exists($controller)) {
                $controllerPath = 'controllers/' . $controller . '.php';
                if (file_exists($controllerPath)) {
                    require_once 'controllers/' . $controller . '.php';
                } else {
                    return false;
                }
            }

            $controller = '\gallery\controllers\\' . $controller;

            $controller = new $controller();
            return $controller->execute($matches);
        }
        return false;
    }

    /**
     * @param $url
     */
    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}