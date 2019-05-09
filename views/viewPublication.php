<div id="pub">
    <section id="pub-info">
        <i><?= $pub->getDate() ?></i>
        <h2>Publication of <?= $pub->getLoginOfPhotoOwner() ?></h2>
        <img width="640px" src="data:image/jpeg;base64,<?= $pub->getPhoto()?>">
    </section>
    <?php
        session_start();
        $login = $_SESSION['login']; ?>
        <section id="com-zone">
            <h2>Comments</h2>
            <?php if ($login != null): ?>
                <input class="input-com comment" id="comment" type="text" placeholder="Leave a comment">
                <button onclick="comment(<?= $pub->getId() ?>, '<?= $login ?>', <?= $pub->getIdUser() ?>)">Comment</button> 
                <div class="comment" style="display: none"><p></p></div>
                <?php
                    foreach ($pub->getComments() as $comment): ?>
                        <div class="comment">
                            <p id="com-login"><b class="btn-blue"><?= $pub->getLoginOfComment($comment['id_user'])?></b></p>
                            <p id="com-txt"> <?= $comment['comment'] ?></p>
                        </div>
                <?php endforeach; ?>
            <?php else : ?>
                <a href="<?= URL ?>?url=login">Log in</a> or <a href="<? URL ?>?url=register">register</a> to comment a publication
            <?php endif; ?>
        </section>
</div>
<script src="<?= URL ?>scripts/publication.js"></script>