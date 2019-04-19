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
                    <img class="article-img"  onclick="displayModalPic(<?= $index ?>)" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
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
<div id="modalPic" class="modal">
    <div class="modal-content">
        <img id="modal-img">
        <h2>Commentaires</h2>
        <?php if ($loggued == true): ?>
            <input class="input-com comment" id="comment" type="text" placeholder="Leave a comment">
            <button class="btn-blue" style="float: right" onclick="comment(<?= $photos[0]->getId() ?>)">Comment</button>
        <?php else : ?>
            <a href="<?= URL ?>?url=login">Log in</a> or <a href="<? URL ?>?url=register">register</a> to comment a publication
        <?php endif; ?>
    </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>