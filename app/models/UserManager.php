<?php 
    class UserManager extends Model {
        public function getUsers() {
            $this->getCo();
            return ($this->getAll('users', 'login'));
        }

        public function userExist($login) {
            $req = $this->getCo()->prepare("SELECT login FROM users WHERE LOGIN LIKE '$login'");
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                // A user with the same login found
                if (isset($data))
                    return (true);
            }
            $req->closeCursor();
            return (false);
        }

        public function addUser($firstname, $lastname, $login, $mail, $hash, $key) {
            $query = "INSERT INTO users VALUES(id_user, '$firstname', '$lastname', '$login', '$mail', '$hash', '$key', true)";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $req->closeCursor();
        }
    }
?>