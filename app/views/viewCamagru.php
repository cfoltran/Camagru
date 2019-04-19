
<div class="center">
    <video id="video" width="640px" autoplay></video>
    <canvas class="center" id="canvas" value="pic" height="480px" width="640px"></canvas>
    <div class="info" id="photoInfo"></div>
    <div id="cam-button">
        <button id="snap" type="button" class="btn-round rounded"><i class="fas fa-camera"></i></button>
        <button id="snap-push" type="submit" name="pic" class="btn-round rounded"><i class="fas fa-check"></i></button>
    </div>
</div>
<h1 style="margin-top: 40px">Ma librairie</h1>
<section class="cards">
    <?php
    $index = -1;
    session_start();
    if ($photos != null): 
        foreach ($photos as $photo): $index++?>
            <article>
                <img class="article-img" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
                <div class="article-title">
                    <i class="fas fa-trash-alt" onclick="dropPhoto(<?= $photos[$index]->getId()?>, <?= $index ?>)"></i>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<script src="<?= URL ?>scripts/camagru.js"></script>