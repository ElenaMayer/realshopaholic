<div class="comment-heading">
    <h3><?= count($comments) ?> <?php if(count($comments)%10 == 1):?>Комментарий<?php elseif(count($comments)%10 > 1 && count($comments)%10 < 5):?>Комментария<?php else:?>Комментариев<?php endif;?></h3>
</div>
<?php foreach ($comments as $comment):?>
    <?php if(!$comment->parent_id):?>
        <div class="single-comment">
            <div class="media">
                <div class="media-left text-center">
                    <img class="media-object" src="/images/avatar.png" alt="">
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        <h3 class="text-uppercase"><?= $comment->author->username ?> <a href="" class="pull-right reply-btn">Ответить</a></h3>
                    </div>
                    <span class="comment-date"><?= $comment->getTimeString() ?></span>
                    <p class="comment-p"><?= $comment->comment ?></p>
                </div>
            </div>
        </div>

        <?php if($replays = $comment->comments):?>
            <?php foreach ($replays as $replay):?>
                <div class="single-comment single-comment-reply">
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