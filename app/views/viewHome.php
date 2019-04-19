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
                        <i onclick="like(<?= $photo->getId() ?>, <?=$index?>, <?= $loggued ?>)"class="fas fa-thumbs-up"> <?= $photo->getLikeNumber($photo->getId()) ?></i>
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
        <input class="input-com comment" id="comment" type="text" placeholder="Leave a comment">
        <button class="btn-blue" style="float: right" onclick="comment(<?= $photos[0]->getId() ?>)">Comment</button>     
    </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>