<section class="cards">
    <?php
    $selected = 0;
    $index = -1;
    foreach ($photos as $photo): $index++?>
        <section class="cards">
            <article>
                <img class="article-img"  onclick="displayModalPic(<?= $index ?>)" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
                <div class="article-title">
                    <i class="fas fa-thumbs-up"></i> 100
                    <i class="fas fa-comments"></i> 100
                </div>
            </article>
        </section>    
    <?php endforeach; ?>
</section>
<div id="modalPic" class="modal">
  <div class="modal-content">
    <img id="modal-img" src="data:image/jpeg;base64,<?= $photos[$selected]->getPhoto()?>">
    <h2>Commentaires</h2>
    <input class="input-com comment" type="text" placeholder="Leave a comment">
    <button class="btn-blue" style="float: right">Comment</button>
    <div class="comment">
        <p><b class="btn-blue">Clément Foltran</b> Anim anim incididunt eiusmod consequat amet.</p>
    </div>
  </div>
</div>
<script src="<?= URL ?>scripts/home.js"></script>