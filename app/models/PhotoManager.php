<?php
class PhotoManager extends Model {
    public function getPhotos() {
        $this->getCo();
        return ($this->getAll('photos', 'photo'));
    }

    public function like($id_photo, $id_user) {
        $query = "INSERT INTO likes VALUES($id_photo, $id_user)";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }

    public function unlike($id_photo, $id_user) {
        $query = "DELETE FROM likes WHERE id_user LIKE $id_user AND id_photo LIKE $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
    }

    public function alreadyLike($id_photo, $id_user) {
        $query = "SELECT * FROM likes WHERE id_user LIKE $id_user AND id_photo LIKE $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            if (isset($data))
                return (true);
        }
        return (false);
        $req->closeCursor();
    }

    public function getLikeNumber($id_photo) {
        $query = "SELECT COUNT(id_photo) AS 'like_number' FROM likes WHERE id_photo LIKE $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data['like_number']);
        $req->closeCursor();
    }

    public function getCommentNumber($id_photo) {
        $query = "SELECT COUNT(id_photo) AS 'comment_number' FROM comments WHERE id_photo LIKE $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data['comment_number']);
        $req->closeCursor();
    }

    public function getComments($id_photo) {
        $query = "SELECT comment FROM comments WHERE id_photo LIKE $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        print_r($data);die();
        $req->closeCursor();
    }

    public function addImage($data, $id_user) {
        $query = "INSERT INTO photos VALUES(id_photo, '$data', NOW(), '$id_user')";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }
}
?>