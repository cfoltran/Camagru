<div id="home">
    <section class="cards">
        <?php
        session_start();
        $index = -1;
        $loggued = false;
        if (isset($_SESSION['login'])) {
            $loggued = true;
        }
        if ($photos != null): 
            foreach ($photos as $photo): $index++?>
                <section class="cards">
                    <article>
                        <a href="<?=URL?>?url=publication&id=<?= $photo->getId()?>">
                            <img class="article-img" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
                        </a>
                        <div class="article-title">
                            <?php if ($loggued == true): ?>
                                <i onclick="like(<?= $photo->getId() ?>, <?=$index?>, <?= $loggued ?>)"class="fas fa-thumbs-up"> <?= $photo->getLikeNumber($photo->getId()) ?></i>
                            <?php else: ?>
                                <a style="color: black" href="<?= URL ?>?url=login">
                                    <i class="fas fa-thumbs-up"> <?= $photo->getLikeNumber($photo->getId()) ?></i>
                                </a>
                            <?php endif; ?>
                            <a style="color: black" href="<?=URL?>?url=publication&id=<?= $photo->getId()?>">
                                <i class="fas fa-comments"> <?= $photo->getCommentNumber()?></i>
                            </a>
                        </div>
                    </article>
                </section>    
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
    <div id="paginator">
        <?php $prevpage = intval($_GET['n']) - 1;
            if ($page == $tpages) : ?>
            <a id="btn-load" href="?url=home&submit=page&n=<?= $prevpage ?>"><i class="fas fa-arrow-circle-left"></i></a>
        <?php elseif ($page == 1) : ?>
            <a id="btn-load" href="?url=home&submit=page&n=<?= $page ?>"><i class="fas fa-arrow-circle-right"></i></a>
        <?php else : ?>
            <a id="btn-load" href="?url=home&submit=page&n=<?= $prevpage ?>"><i class="fas fa-arrow-circle-left"></i></a>
            <a id="btn-load" href="?url=home&submit=page&n=<?= $page ?>"><i class="fas fa-arrow-circle-right"></i></a>
        <?php endif; ?>
        <p>Page <?= $page ?> / <?= $tpages ?></p>
    </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>