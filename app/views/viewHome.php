<?php
    foreach ($photos as $photo): ?>
    <img src="data:image/jpeg;base64,<?=$photo->getPhoto()?>">
<?php endforeach; ?>