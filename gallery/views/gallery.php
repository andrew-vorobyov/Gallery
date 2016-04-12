<div class="col-lg-6 col-lg-offset-3">

    <ul class="nav nav-pills gallery-nav">
        <li role="presentation" class="active"><a
                href="/user/<?php echo \gallery\components\UserSession::getInstance()->username; ?>"><?php echo \gallery\components\UserSession::getInstance()->username; ?></a>
        </li>
        <li role="presentation"><a href="/photo">Add Photo</a></li>
        <li role="presentation"><a href="/logout">Log Out</a></li>
    </ul>

    <ul class="nav nav-pills gallery-nav">
        <li role="presentation" class="active"><b style="color: limegreen">Колличество постов на странице:</b></li>
        <li role="presentation" class="active"><a href="/user/<?php echo \gallery\components\UserSession::getInstance()->username; ?>/pp5/">5</a>
        </li>
        <li role="presentation"><a href="/user/<?php echo \gallery\components\UserSession::getInstance()->username; ?>/pp10/">10</a></li>
        <li role="presentation"><a href="/user/<?php echo \gallery\components\UserSession::getInstance()->username; ?>/pp100/">Все</a></li>
    </ul>

    <div class="photos">

        <?php

        if ($photos) {
            foreach ($photos as $photo): ?>

                <div class="photo">
                    <a href="/user/<?php echo $username ?>/photo/<?php echo $photo['id'] ?>">
                        <img src="/pictures/<?php echo $username ?>/<?php echo $photo['photoURI'] ?>"/>
                    </a>

                    <p>
                        <?php echo \gallery\models\Picture::formatDate($photo['date']); ?>
                    </p>

                    <p>
                        <?php echo $photo['description']; ?>
                    </p>

                    <div class="form-group">
                        <a href="/photoDel/<?php echo $photo['id'] ?>/" class="btn btn-danger pull-right">Delete
                            Photo</a>

                        <div class="clearfix"></div>
                    </div>

                    <hr/>
                </div>

            <?php endforeach;
        } ?>

        <ul class="nav nav-pills gallery-nav">
            <?php
            $p = new \gallery\components\Pagination($postCount, $perPage, $page);
            $p->pagination();
            ?>
        </ul>


    </div>
</div>

