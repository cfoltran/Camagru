<?php
class PhotoManager extends Model {
    public function getPhotos() {
        $this->getCo();
        return ($this->getAll('photos', 'photo'));
    }

    public function getPhoto($id) {
        $req = $this->getCo()->prepare("SELECT * FROM photos WHERE id_photo = $id");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return (new Photo($data));
        $req->closeCursor();
    }

    public function like($id_photo, $id_user) {
        $query = "INSERT INTO likes VALUES($id_photo, $id_user)";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }

    public function comment($id_photo, $id_user, $comment) {
        $query = "INSERT INTO comments VALUE(id_comment, :id_photo, $id_user, :comment)";
        $req = $this->getCo()->prepare($query);
        $req->execute([
            ':id_photo' => $id_photo,
            ':comment' => $comment
        ]);
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
        $tab = [];
        $query = "SELECT * FROM comments WHERE id_photo LIKE $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $tab[] = $data;
        }
        return ($tab);
        $req->closeCursor();
    }

    public function addImage($data, $id_user) {
        $timestamp = time();
        $query = "INSERT INTO photos VALUES(id_photo, '$data', NOW(), $timestamp ,'$id_user')";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }

    public function getPhotosUser($id_user) {
        $query = "SELECT * FROM photos WHERE id_user = $id_user";
        $tab = [];
        $req = $this->getCo()->prepare($query);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $tab[] = new Photo($data);
        }
        return $tab;
        $req->closeCursor();
    }

    public function dropComments($id_photo) {
        $query = "DELETE FROM comments WHERE id_photo = $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }

    public function dropLikes($id_photo) {
        $query = "DELETE FROM likes WHERE id_photo = $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }

    public function dropPhoto($id_photo) {
        // Drop comment and likes before
        $this->dropLikes($id_photo);
        $this->dropComments($id_photo);
        // Delete the photo
        $query = "DELETE FROM photos WHERE id_photo = $id_photo";
        $req = $this->getCo()->prepare($query);
        $req->execute();
        $req->closeCursor();
    }

    public function getAllPhotos($limit) {
        $tab = [];
        $min = $limit - 6;
        $req = $this->getCo()->prepare("SELECT * FROM photos ORDER BY timestamp DESC LIMIT $min, 6");
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $tab[] = new Photo($data);
        }
        return $tab;
        $req->closeCursor();
    }

    public function countPhotos() {
        $req = $this->getCo()->prepare("SELECT COUNT(id_photo) AS 'nb_photos' FROM photos");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data['nb_photos']);
        $req->closeCursor();
    }
}
?>