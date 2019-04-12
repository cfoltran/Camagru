<?php
class PhotoManager extends Model {
    public function getPhotos() {
        $this->getCo();
        return ($this->getAll('photos', 'photo'));
    }
}
?>