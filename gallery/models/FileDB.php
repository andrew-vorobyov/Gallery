<?php

namespace gallery\models;

/**
 * Class FileDB
 * @package gallery\models
 */
class FileDB
{
    private $path;
    const USERS_FILE = 'usersFile.json';
    const PREFIX = 'photos_';

    /**
     * FileDB constructor.
     * @param string $path
     */
    public function __construct($path = './db')
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $this->path = $path;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function findUser($username, $password)
    {
        if ($f = fopen($this->path . DIRECTORY_SEPARATOR . FileDB::USERS_FILE, 'r')) {
            while (!feof($f)) {
                if ($str = fgets($f)) {
                    if ($json = json_decode($str, true)) {
                        if ($json['username'] == $username && $json['password'] == sha1($password)) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $username
     * @return bool
     */
    public function findUsername($username)
    {
        if ($f = fopen($this->path . DIRECTORY_SEPARATOR . FileDB::USERS_FILE, 'r')) {
            while (!feof($f)) {
                if ($str = fgets($f)) {
                    if ($json = json_decode($str, true)) {
                        if ($json['username'] == $username) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     */
    public function addUser($username, $password)
    {
        $f = fopen($this->path . DIRECTORY_SEPARATOR . self::USERS_FILE, 'a+');
        fwrite($f, json_encode([
                'id' => time(),
                'username' => $username,
                'password' => sha1($password),
            ]) . PHP_EOL);
        fclose($f);
    }

    /**
     * @param $username
     * @param $photoURI
     * @param $description
     */
    public function addPhoto($username, $photoURI, $description)
    {
        $f = fopen($this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json', 'a+');
        fwrite($f, json_encode([
                'id' => time(),
                'username' => $username,
                'photoURI' => $photoURI,
                'description' => $description,
                'date' => date('Y-m-d H:i:s'),
            ]) . PHP_EOL);
        fclose($f);
    }

    /**
     * @param $username
     * @param $photoId
     * @return array|bool
     */
    public function getPhoto($username, $photoId)
    {
        $path = $this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json';
        if (!file_exists($path)) {
            return false;
        }
        $f = fopen($path, 'r');
        while (!feof($f)) {
            if ($str = fgets($f)) {
                if ($json = json_decode($str, true)) {
                    if ($photoId == $json['id']) {
                        return [
                            'photoURI' => $json['photoURI'],
                            'description' => $json['description'],
                        ];
                    }
                }
            }
        }
    }

    public function getPhotos($username, $page, $perPage)
    {
        $path = $this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json';
        if (!file_exists($path)) {
            return false;
        }
        $f = fopen($path, 'r');

        $photoCount = 0;
        while (!feof($f)) {
            if ($str = fgets($f)) {
                $photoCount++;
                if ($photoCount >= ($page * $perPage - $perPage + 1) && $photoCount <= ($page * $perPage)) {
                    if ($str = json_decode($str, true)) {
                        $photosToDisplay[] = $str;
                    }
                }
            }
        }
        if ($photoCount > 0) {
            return $photosToDisplay;
        } else {
            return $photosToDisplay = false;
        }
    }

    public function deletePhoto($username, $id)
    {
        $path = $this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json';
        if (!file_exists($path)) {
            return false;
        }

        $f = fopen($path, 'r');
        $tFile = tempnam($this->path, 'temp');
        $t = fopen($tFile, 'a+');

        while (!feof($f)) {
            if ($str = fgets($f)) {
                if ($json = json_decode($str, true)) {
                    if ($id != $json['id']) {
                        fwrite($t, $str . PHP_EOL);
                    }
                }
            }
        }

        fclose($t);
        fclose($f);

        rename($tFile, $path);
        return true;
    }

    public function PostCount($username)
    {

        $path = $this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json';
        if (!file_exists($path)) {
            return false;
        }

        $count = 0;
        $f = fopen($path, 'r');

        while (!feof($f)) {
            fgets($f);
            $count++;
        }
        return $count;
    }
}
