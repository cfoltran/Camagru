<section class="cards">
    <?php
    $selected = 0;
    $index = -1;
    session_start();
    if ($photos != null):
        
        foreach ($photos as $photo): $index++?>
            <section class="cards">
                <article>
                    <img class="article-img"  onclick="displayModalPic(<?= $index ?>)" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
                    <div class="article-title">
                        <i onclick="like(<?= $photo->getId() ?>)"class="fas fa-thumbs-up"></i> <?= $photo->getLikeNumber($photo->getId()) ?>
                        <i class="fas fa-comments"></i> <?= $photo->getCommentNumber() ?>
                    </div>
                </article>
            </section>    
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<div id="modalPic" class="modal">
    <div class="modal-content">
        <img id="modal-img" src="data:image/jpeg;base64,<?= $photos[$selected]->getPhoto()?>">
        <h2>Commentaires</h2>
        <input class="input-com comment" id="comment" type="text" placeholder="Leave a comment">
        <button class="btn-blue" style="float: right" onclick="comment(<?= $photos[$selected]->getId() ?>)">Comment</button>
        <?php if ($photos[$selected]->getComments() != null): ?>
            <?php foreach ($photos[$selected]->getComments() as $comment): ?>
                <div class="comment">
                    <p><b class="btn-blue"><?= $_SESSION['login']?></b> <?= $comment ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>