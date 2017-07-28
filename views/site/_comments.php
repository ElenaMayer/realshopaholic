<div class="comment-heading">
    <h3><?= count($comments) ?> <?php if(count($comments)%10 == 1):?>Комментарий<?php elseif(count($comments)%10 > 1 && count($comments)%10 < 5):?>Комментария<?php else:?>Комментариев<?php endif;?></h3>
</div>
<?php foreach ($comments as $key => $comment):?>
    <?php if(!$comment->parent_id):?>
        <div id="<?= $comment->id?>" class="single-comment<?php if (isset($new_comment) && $new_comment->id == $comment->id):?> new-comment<?php endif;?>">
            <div class="media">
                <div class="media-left text-center">
                    <img class="media-object" src="/images/avatar.png" alt="">
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        <h3 class="text-uppercase"><?= $comment->author->username ?>
                            <a id="replay-btn" class="pull-right reply-btn <?php if(Yii::$app->user->isGuest):?>disabled<?php endif;?>">Ответить</a>
                        </h3>
                        <?php if(Yii::$app->user->isGuest):?>
                            <div class="comment-ignoring__popup" style="display: none;">
                                <span class="comment-ignoring__text">
                                    <a class="comment-ignoring__link" href="/user/login?returnUrl=<?= $_SERVER['REQUEST_URI'] ?>#<?= $comment->id?>">Авторизуйтесь</a>,
                                    <br>чтобы&nbsp;иметь&nbsp;возможность
                                    <br>отвечать на&nbsp;комментарии
                                </span>
                            </div>
                        <?php endif;?>
                    </div>
                    <span class="comment-date"><?= $comment->getTimeString() ?></span>
                    <p class="comment-p"><?= $comment->comment ?></p>
                </div>
            </div>
        </div>

        <?php if($replays = $comment->comments):?>
            <?php foreach ($replays as $replay):?>
                <div id="<?= $replay->id?>" class="single-comment single-comment-reply<?php if (isset($new_comment) && $new_comment->id == $replay->id):?> new-comment<?php endif;?>">
                    <div class="media">
                        <div class="media-left text-center">
                            <img class="media-object" src="/images/avatar.png" alt="">
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <h3 class="text-uppercase"><?= $replay->author->username ?></h3>
                            </div>
                            <span class="comment-date"><?= $replay->getTimeString() ?></span>
                            <p class="comment-p"><?= $replay->comment ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    <?php endif;?>
<?php endforeach;?>
