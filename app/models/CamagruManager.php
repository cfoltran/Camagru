<?php
class CamagruManager extends Model {
    public function addImage($data) {
        $query = "INSERT INTO photos VALUES(id_photo, '$data', NOW())";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }
}
?>