<div class="col-md-4">
    <!-- start sidebar -->
    <div class="sidebar">
        <aside class="widget about-me-widget"><!-- start single widget -->

            <div class="about-me-img">
                <img src="../images/aboout-me.jpg" alt="" class="img-me">
            </div>
            <div class="about-me-content">
                <h3>Майер Елена <span>О проекте</span></h3>

                <p>В ритме современной жизни хочется найти время на все множество занятий и при этом может
                    не остаться время и желания на поход в магазины. Чтобы сэкономить время и усилия сейчас существует
                    уникальная сфера интернет-шоппинга, она позволит вам найти качесвенноые,
                    недрогие и эксклюзивные товары со всего мира. А я помогу вам разобраться во всем их многообразии. </p>
            </div>

        </aside><!-- end single widget -->
        <aside class="widget"><!-- start single widget -->
            <div class="social-share">
                <h3 class="widget-title text-uppercase">Мы в соцсетях</h3>
                <ul class="">
                    <li><a class="s-vk" href=""><i class="fa fa-vk"></i></a></li>
                    <li><a class="s-instagram" href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a class="s-facebook" href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a class="s-youtube" href=""><i class="fa fa-youtube-play"></i></a></li>
                </ul>
            </div>
        </aside><!-- end single widget -->
        <aside class="widget news-letter"><!-- start single widget -->
            <h3 class="widget-title text-uppercase">Подписка на обновления</h3>
            <p>Подпишись на обновления и узнай первым о новых статьях, обзорах и инструкциях.</p>
            <form action="#">
                <input type="email" placeholder="Ваш e-mail">
                <input type="submit" value="Подписаться"
                       class="text-uppercase text-center btn btn-subscribe">
            </form>
        </aside><!-- end single widget -->
        <aside class="widget p-post-widget">
            <h3 class="widget-title text-uppercase">Последние посты</h3>
            <?php foreach ($posts as $post):?>
                <div class="popular-post">
                    <a href="/post/<?= $post->id?>" class="popular-img"><img src="../<?=$post->image?>" alt="<?=$post->title?>">
                        <div class="p-overlay"></div>
                    </a>
                    <div class="p-content">
                        <a href="/post/<?= $post->id?>"><?=$post->title?></a>
                        <span class="p-date"><?= $post->getTimeString() ?></span>
                    </div>
                </div>
            <?php endforeach;?>
        </aside>
        <aside class="widget"><!-- start single widget -->
            <h3 class="widget-title text-uppercase">Популярные посты</h3>
            <?php foreach ($posts as $post):?>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="/post/<?= $post->id?>" class="popular-img"><img src="../<?=$post->image?>" alt="<?=$post->image?>">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <h3><a href="/post/<?= $post->id?>"><?=$post->title?></a></h3>
                            <span class="p-date"><?= $post->getTimeString() ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </aside><!-- end single widget -->
        <aside class="widget category-post-no"><!-- start single widget -->
            <h3 class="widget-title text-uppercase">Категории</h3>
            <ul>
                <?php foreach ($categories as $category):?>
                    <li>
                        <a href="/category/<?= $category->id ?>"><?= $category->description ?></a>
                        <span class="post-count pull-right"> <?= \amilna\blog\models\BlogCatPos::find()->where(['category_id' => $category->id])->count();?> </span>
                    </li>
                <?php endforeach;?>
            </ul>
        </aside><!-- end single widget -->
        <aside class="widget widget-texty"><!-- start single widget -->
            <h3 class="widget-title text-uppercase">Textual@Instagram</h3>
            <ul>
                <li><a href=""><img src="../images/instra-1.jpg" alt="">
                    </a></li>
                <li><a href=""><img src="../images/instra-2.jpg" alt=""></a></li>
                <li><a href=""><img src="../images/instra-3.jpg" alt=""></a></li>
                <li><a href=""><img src="../images/instra-4.jpg" alt=""></a></li>
            </ul>
        </aside><!-- end single widget -->
        <aside class="widget widget-tag"><!-- start single widget -->
            <h3 class="widget-title text-uppercase">Облако тэгов</h3>
            <?php foreach ($tags as $tag):?>
                <a href="/tag/<?= $tag->tags ?>"><?= $tag->tags ?></a>
            <?php endforeach;?>
        </aside><!-- end single widget -->
    </div>
    <!-- end sidebar -->
</div>