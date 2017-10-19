<?php foreach ($snippets as $id => $snippet):?>
    <article class="post list-post">
        <div class="media">
            <div class="media-left">
                <div class="post-thumb">
                    <a href="single-post.html"><img src="../<?= $snippet['image']?>" alt="<?= $snippet['title']?>"></a>
                    <a href="/post/<?= $id?>" class="post-thumb-overlay text-center">
                        <div class="text-uppercase text-center"><i class="fa fa-search"></i></div>
                    </a>
                </div>
            </div>
            <div class="post-content">
                <div class="post-header">
                    <h2><a href="/post/<?= $id?>"><?= $snippet['title']?> </a> <span class="pull-right"><?= \app\controllers\SiteController::getTimeString($snippet['time']) ?></span></h2>
                </div>
                <div class="entry-content">
                    <p><?= $snippet['description']?></p>
                    <p><?= $snippet['content']?></p>
                    <div class="continue-reading text-uppercase">
                        <a href="/post/<?= $id?>" class="more-link text-center">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php endforeach;?>
<!--pagination-->
<!--<div class="post-pagination text-center">-->
<!--    <ul class="pagination">-->
<!--        <li class="active"><a href="#">1</a></li>-->
<!--        <li><a href="#">2</a></li>-->
<!--        <li><a href="#">3</a></li>-->
<!--        <li><a href="#">Next</a></li>-->
<!--    </ul>-->
<!--</div>-->