<section class="cards">
    <?php
    $index = -1;
    session_start();
    if ($photos != null): 
        foreach ($photos as $photo): $index++?>
            <section class="cards">
                <article>
                    <img class="article-img"  onclick="displayModalPic(<?= $index ?>)" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
                    <div class="article-title">
                        <i onclick="like(<?= $photo->getId() ?>, <?=$index?>)"class="fas fa-thumbs-up"> <?= $photo->getLikeNumber($photo->getId()) ?></i>
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
        
            <?php foreach ($photos[0]->getComments() as $comment): ?>
                <div class="comment">
                    <p><b class="btn-blue"><?= $_SESSION['login']?></b> <?= $comment ?></p>
                </div>
            <?php endforeach; ?>
        
    </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>