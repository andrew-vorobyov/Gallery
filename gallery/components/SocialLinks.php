<?php

namespace gallery\components;

use SocialLinks\Page;

/**
 * Class SocialLinks
 * @package gallery\components
 */
class SocialLinks
{

    /**
     * @param $url
     * @param $title
     * @param $text
     * @param $image
     * @param $twitterUser
     * @return array
     */
    public static function shareLinks($url, $title, $text, $image, $twitterUser)
    {
        $page = new Page([
            'url' => $url,
            'title' => $title,
            'text' => $text,
            'image' => $image,
            'twitterUser' => $twitterUser
        ]);

        $socialArr = [];
        $socialArr['vk'] = [
            'Share in Vk',
            $page->vk->shareUrl,
            $page->vk->shareCount];

        $socialArr['facebook'] = [
            'Share in Facebook',
            $page->facebook->shareUrl,
            $page->facebook->shareCount
        ];

        $socialArr['linkedin'] = [
            'Share in Linkedink',
            $page->linkedin->shareUrl,
            $page->linkedin->shareCount
        ];
        return $socialArr;
    }
}