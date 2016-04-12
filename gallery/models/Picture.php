<?php

namespace gallery\models;

/**
 * Class Picture
 * @package gallery\models
 */
class Picture
{
    /**
     * @param $dateStr
     * @return string
     */
    public static function formatDate($dateStr)
    {
        $date = new \DateTime($dateStr);
        $date->add(new \DateInterval("PT2H"));
        return $date->format('d.m.Y H:i');
    }

    /**
     * @param $photoPath
     */
    public static function thumbnailPhoto($photoPath)
    {
        $img = new \Imagick($photoPath);

        $w1 = $img->getImageWidth();
        $h1 = $img->getImageHeight();

        $w2 = 512;
        $h2 = ($h1 * $w2) / $w1;

        $img->thumbnailImage($w2, $h2);
        $img->setImageCompressionQuality(70);

        $img->writeImage($photoPath);
    }

    /**
     * @param $tmpPath
     * @param $fileName
     * @param $username
     * @return string
     */
    public static function uploadFile($tmpPath, $fileName, $username)
    {
        $pictureDir = __DIR__ . '/../pictures';
        $usernameDir = $pictureDir . '/' . $username;

        if (!file_exists($usernameDir)) {
            mkdir($usernameDir);
        }

        $pahInfo = pathinfo($fileName);
        $ext = isset($pahInfo['extension']) ? $pahInfo['extension'] : 'jpg';
        $time = time();
        $fileName = $time . '.' . $ext;
        $imageNewPath = $usernameDir . '/' . $fileName;
        move_uploaded_file($tmpPath, $imageNewPath);

        return $fileName;
    }
}