<div id="camagru">
    <?php session_start() ?>
    <h3>Hello <?= $_SESSION['login'] ?></h3>
    <section id="cam">
        <div id="video_box">
            <div>
                <video id="video" width="640px" autoplay></video>
                <canvas id="canvas" height="480px" width="640px"></canvas>
            </div>
            <div class="info" id="photoInfo"></div>
        </div>
        <div id="import-zone">    
            <label>Import PNG image
                <input id="import-img" name="img" type="file" accept="image/png">
            </label>
            <button onclick="addPhoto()">Import</button>
        </div>
        <div id="cam-button">
            <button id="snap" type="button" class="btn-round rounded"><i class="fas fa-camera"></i></button>
            <button id="snap-push" type="submit" onclick="addPhoto()" class="btn-round rounded"><i class="fas fa-check"></i></button>
            <button id="import" type="submit" class="btn-round rounded"><i class="fas fa-upload"></i></button>
        </div>
        <div id="cam-filters">
            <?php for ($i = 1; $i < 6; $i++): ?>
                <label>
                    <input type="radio" name="filter" id="filter">
                    <img src="<?= URL ?>public/asset/<?= $i ?>.png" onclick="setFilter(this)">
                </label>
            <?php endfor; ?>
        </div>
    </section>
    <section id="cards" class="cards">
        <?php $index = -1;?> 
        <article style="display: none">
            <img class="article-img">
            <div class="article-title">
                <i class="fas fa-trash-alt"></i>
            </div>
        </article>
        <?php foreach (array_reverse($photos) as $photo): $index++?>
            <article>
                <img class="article-img" src="data:image/jpeg;base64,<?= $photo->getPhoto()?>">
                <div class="article-title">
                    <i class="fas fa-trash-alt" onclick="dropPhoto(<?= $photos[$index]->getId()?>, this)"></i>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</div>
<script src="<?= URL ?>scripts/camagru.js"></script>