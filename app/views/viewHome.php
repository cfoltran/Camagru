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
                        <a href="<?=URL?>?url=publication&id=<?= $photo->getId()?>"><img class="article-img" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>"></a>
                        <div class="article-title">
                            <?php if ($loggued == true): ?>
                                <i onclick="like(<?= $photo->getId() ?>, <?=$index?>, <?= $loggued ?>)"class="fas fa-thumbs-up"> <?= $photo->getLikeNumber($photo->getId()) ?></i>
                            <?php else: ?>
                                <a style="color: black" href="<?URL?>?url=login"><i class="fas fa-thumbs-up"> <?= $photo->getLikeNumber($photo->getId()) ?></i></a>
                            <?php endif; ?>
                            <i class="fas fa-comments"> <?= $photo->getCommentNumber()?></i>
                        </div>
                    </article>
                </section>    
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
    <div id="paginator">
        <?php if ($page < $tpages) : ?>
            <a id="btn-load" href="?url=home&submit=page&n=<?= $page ?>">Load photos</a>
        <?php endif; ?>
        <p>Page <?= $page ?> / <?= $tpages ?></p>
    </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>