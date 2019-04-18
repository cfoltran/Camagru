<?php 
    class UserManager extends Model {
        public function getUsers() {
            $this->getCo();
            return ($this->getAll('users', 'login'));
        }

        public function getUserId($login) {
            $query = "SELECT id_user FROM users WHERE login LIKE '$login'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                return ($data['id_user']);
            }
            $req->closeCursor();
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
            $query = "INSERT INTO users VALUES(id_user, '$firstname', '$lastname', '$login', '$mail', '$hash', '$key', false)";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $req->closeCursor();
        }

        public function login($login, $hash) {
            $query = "SELECT passwd, confirm FROM users WHERE login = '$login'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data['confirm'] == 0) {
                return (1);
            } else if ($data['passwd'] === $hash) {
                return (0);
            } else {
                return (2);
            }
            $req->closeCursor();
        }

        public function checkPassword($hash, $login) {
            $query = "SELECT * FROM users WHERE login LIKE '$login' AND passwd LIKE '$hash'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                if (isset($data))
                    return (true);
            }
            return (false);
            $req->closeCursor();
        }

        public function updatePassword($hash, $login) {
            $query = "UPDATE users SET passwd='$hash' WHERE login LIKE '$login'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $req->closeCursor();
        }

        public function checkConfKey($key, $login) {
            $query = "SELECT * FROM users WHERE login LIKE '$login' AND confirmKey LIKE '$key'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                if (isset($data))
                    return (true);
            }
            return (false);
            $req->closeCursor();
        }

        public function confirmAccount($login) {
            $query = "UPDATE users SET confirm = true";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $req->closeCursor();
        }

        public function updateLogin($login) {
            session_start();
            $old_login = $_SESSION['login'];
            $query = "UPDATE users SET login = '$login' WHERE login = '$old_login'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $req->closeCursor();
        }

        public function getConfirmKey($email) {
            $query = "SELECT confirmKey FROM users WHERE email = '$email'";
            $req = $this->getCo()->prepare($query);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return ($data);
            $req->closeCursor();
        }
    }
?>
