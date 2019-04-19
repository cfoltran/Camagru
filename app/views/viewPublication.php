<div id="pub">
    <img src="data:image/jpeg;base64,<?= $pub->getPhoto()?>">
    <h2>Commentaires</h2>
    <?php if ($loggued == true): ?>
        <input class="input-com comment" id="comment" type="text" placeholder="Leave a comment">
        <button class="btn-blue" style="float: right" onclick="comment(<?= $photos[0]->getId() ?>)">Comment</button>
    <?php else : ?>
        <a href="<?= URL ?>?url=login">Log in</a> or <a href="<? URL ?>?url=register">register</a> to comment a publication
    <?php endif; ?>
    <?php if ($pub->getComments() != false):
        foreach ($pub->getComments() as $comment): ?>
            <div class="comment">
                <p><b class="btn-blue">TODO</b> <?= $comment ?></p>
                
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>