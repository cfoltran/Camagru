<div id="pub">
    <section id="pub-info">
        <i><?= $pub->getDate() ?></i>
        <h2>Publication of <?= $pub->getLoginOfPhotoOwner() ?></h2>
        <img width="640px" src="data:image/jpeg;base64,<?= $pub->getPhoto()?>">
    </section>
    <?php
        session_start();
        $login = $_SESSION['login'];
        if ($login != null): ?>
        <section id="com-zone">
            <h2>Comments</h2>
            <input class="input-com comment" id="comment" type="text" placeholder="Leave a comment">
            <button class="btn-blue" onclick="comment(<?= $pub->getId() ?>, '<?= $login ?>', <?= $pub->getIdUser() ?>)">Comment</button>
            <div class="comment" style="display: none"><p></p></div>
            <?php
                foreach ($pub->getComments() as $comment): ?>
                    <div class="comment">
                        <p><b class="btn-blue"><?= $pub->getLoginOfComment($comment['id_user'])?></b> <?= $comment['comment'] ?></p>
                    </div>
            <?php endforeach; ?>
        </section>
    <?php else : ?>
        <a href="<?= URL ?>?url=login">Log in</a> or <a href="<? URL ?>?url=register">register</a> to comment a publication
    <?php endif; ?>
</div>
<script src="<?= URL ?>scripts/publication.js"></script>