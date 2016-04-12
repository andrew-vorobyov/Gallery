<?php

namespace gallery\components;

/**
 * Class Pagination
 * @package gallery\components
 */
class Pagination
{
    public $postCount;
    public $perPage;
    public $page;

    /**
     * Pagination constructor.
     * @param $postCount
     * @param $perPage
     * @param $page
     */
    public function __construct($postCount, $perPage, $page)
    {
        $this->postCount = $postCount;
        if ($perPage != 0) {
            $this->perPage = $perPage;
        } else {
            $this->perPage = 1;
        }

        if ($page != 0) {
            $this->page = $page;
        } else {
            $this->page = 1;
        }
    }

    /**
     *
     */
    public function pagination()
    {
        $pageCount = ceil($this->postCount / $this->perPage);
        for ($i = 1; $i <= $pageCount; $i++) {
            echo '<li ';
            if ($i == $this->page) {
                echo 'class="active"';
            }
            echo '><a href="/user/' . UserSession::getInstance()->username . '/' . "$i" . '/' . '"' . '>' . "$i" . "</a></li>";
        }
    }
}