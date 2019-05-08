<?php
    require_once('views/View.php');

    class ControllerLogin {
        private $_userManager;
        private $_photosManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'login') {
                $this->_login();
            } else if ($_GET['submit'] === 'logout') {
                $this->_logout();
            } else if ($_GET['submit'] === 'updatePasswd') {
                $this->_updatePassword();
            } else if ($_GET['submit'] === 'updateLogin') {
                $this->_updateLogin();
            } else if ($_GET['submit'] === 'resetPasswd') {
                $this->_resetPasswd();
            } else if ($_GET['submit'] == 'updateMail') {
                $this->_updateMail();
            } else if ($_GET['submit'] === 'getNotif') {
                $this->_getNotif();
            } else if ($_GET['submit'] === 'setNotif') {
                $this->_setNotif();
            } else if ($_GET['submit'] === 'delAccount') {
                $this->_delAccount();
            } else {
                $this->loginView();
            }
        }

        public function loginView() {
            session_start();
            if ($_SESSION['login'] == null) {
                $this->_view = new View('Login');
                $this->_view->generate(array());
            } else {
                $this->_view = new View('Camagru');
                $this->_view->generate(array());
            }
        }

        private function _error($message) {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => $message));
        }

        private function _login() {
            $login = htmlentities($_POST['login']);
            $passwd = $_POST['passwd'];
            $this->_userManager = new UserManager;
            if ($this->_userManager->userExist($login) === false) {
                $this->_error("The login doesn't exist");
            } else {
                $hash = hash('whirlpool', $passwd);
                $logReq = $this->_userManager->login($login, $hash);
                if ($logReq === 1) {
                    $this->_error("Please check your mailbox before continue");
                } else if ($logReq === 2) {
                    $this->_error("Invalid password");
                } else {
                    session_start();
                    $_SESSION['login'] = $login;
                    $_SESSION['id'] = $this->_userManager->getUserId($login);
                    $this->_photosManager = new PhotoManager;
                    $photos = $this->_photosManager->getPhotosUser($_SESSION['id']);
                    $this->_view = new View('Camagru');
                    $this->_view->generate(array('photos' => $photos));
                }
            }
        }

        private function _updatePassword() {
            session_start();
            $new = $_POST['newPasswd'];
            $old = $_POST['oldPasswd'];

            $hash = hash('whirlpool', $old);
            $this->_userManager = new UserManager;
            if ($this->_userManager->checkPassword($hash, $_SESSION['login']) === true) {
                $hash = hash('whirlpool', $new);
                $this->_userManager->updatePassword($hash, $_SESSION['login']);
            }
        }

        private function _logout() {
            session_start();
            $login = $_SESSION['login'];
            $_SESSION['login'] = null;
            $_SESSION['id'] = null;
            $this->_view = new View('Login');
            $this->_view->generate(array('info' => "See you <b>$login</b>"));
        }

        private function _updateLogin() {
            session_start();
            $login = $_POST['login'];
            $this->_userManager = new UserManager;
            if ($this->_userManager->userExist($login) === false && !preg_match('/[^a-z_\-0-9]/i', $login)) {
                $this->_userManager->updateLogin($login);
                echo 0;
            } else {
                echo 1;
            }
        }

        private function _resetPasswd() {
            $email = htmlentities($_POST['email']);
            $key = '';
            $this->_userManager = new UserManager;
            $key = $this->_userManager->getConfirmKey($email);
            if ($key != null)
            {
                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"camagru.fr"<no-reply@camagru.fr>'."\n";
                $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                $message = '<a href="'. URL .'?url=reset&key='. $key .'">Reset your password</a>';
                mail($email, "Camagru reset password", $message, $header);
                echo 0;
            } else {
                echo 1;
            }
        }

        private function _getNotif() {
            session_start();
            $this->_userManager = new UserManager;
            echo $this->_userManager->getNotif($_SESSION['id']);
        }

        private function _setNotif() {
            session_start();
            $notif = $_POST['notif'];
            var_dump($notif);
            $this->_userManager = new UserManager;
            $this->_userManager->setNotif($_SESSION['id'], $notif);
        }

        private function _delAccount() {
            session_start();
            $passwd = $_POST['passwd'];
            $login = $_SESSION['login'];
            $this->_userManager = new UserManager;
            if ($this->_userManager->userExist($login) === false) {
                $this->_error("The login doesn't exist");
            } else {
                $hash = hash('whirlpool', $passwd);
                $logReq = $this->_userManager->login($login, $hash);
                if ($logReq === 2) {
                    $this->_error("Invalid password you have been disconnected");
                } else {
                    // Drop user
                    $this->_userManager->dropUser($_SESSION['id']);
                    $this->_view = new View('Login');
                    $this->_logout();
                }
            }          
        }

        private function _updateMail() {
            session_start();
            $mail = htmlentities($_POST['email']);
            $id_user = $_SESSION['id'];
            $this->_userManager = new UserManager;
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"camagru.fr"<no-reply@camagru.fr>'."\n";
            $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $message = '<a href="'. URL .'?url=reset&submit=mail&mail='. urlencode($mail) . '&id='. $id_user .'">Reset your mail</a>';
            mail($mail, "Camagru reset mail", $message, $header);
            $this->_logout();
        }
    }  
?>