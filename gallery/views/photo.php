<div class="col-lg-6 col-lg-offset-3">

    <div class="form-group">
        <a href="/user/<?php echo \gallery\components\UserSession::getInstance()->username; ?>" class="btn btn-primary">Back
            to Gallery</a>
        <a href="/photoDel/<?php echo $photo['id'] ?>/" class="btn btn-danger pull-right">Delete Photo</a>
        <a href="/user/<?php echo \gallery\components\UserSession::getInstance()->username ?>/photo/<?php echo $photo['id']; ?>/load/"
           class="btn btn-success pull-right">Download Photo</a>


        <div class="c
        learfix"></div>
    </div>

    <div class="photo">

        <a href="/user/<?php echo \gallery\components\UserSession::getInstance()->username ?>/photo/<?php echo $photo['id'] ?>">
            <img
                src="/pictures/<?php echo \gallery\components\UserSession::getInstance()->username ?>/<?php echo $photo['uri'] ?>"/>
        </a>

        <p>
            <b>Описание фотографии:</b>
        </p>

        <p>
            <?php echo \gallery\models\Picture::formatDate($photo['date']); ?>
        </p>

        <p>
            <?php echo $photo['description']; ?>
        </p>

        <p>
            <b>Поделиться фотографией:</b>
        </p>

        <div class="form-group">
            <?php
            \gallery\components\SocialLinks::shareLinks("http://localhost/user/" . \gallery\components\UserSession::getInstance()->username . "/", $photo['description'], 'Extended page description', "http://localhost/user/" . \gallery\components\UserSession::getInstance()->username . "/photo/" . $photo['id'], '@twitterUser');
            ?>
        </div>

        <p>
            <b>Комментарии к данной фотографии:</b>
        </p>

        <?php
        if (isset($photo) && isset($photo['comment'])):
            foreach ($photo['comment'] as $comment): ?>

                <p>
                    <?php
                    echo "<i>" . $comment['name'] . "</i>: <br/>";
                    echo $comment['text'] . "<br/>";
                    echo $comment['date'];
                    ?>
                </p>

            <?php endforeach; ?>
        <?php endif; ?>

        <p>
            <b>Оставить свой комментарий к данной фотографии:</b>
        </p>

        <div class="panel-group">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <form role="form" method="post">

                        <div class="form-group">
                            <label for="name">Имя:</label></br>
                            <input type="text" class="form-control" name="name" id="name"></br>
                        </div>

                        <div class="form-group">
                            <label for="text">Комментарий:</label></br>
                            <textarea name="text" id="text" class="form-control"></textarea></br>
                        </div>

                        <input name="photoId" type="hidden" value="<?php echo $photo['id']; ?>">
                        <input type="submit" class="btn btn-success" name="send" value="Отправить комментарий">

                    </form>
                </div>
            </div>

        </div>

        <hr/>
    </div>

</div>