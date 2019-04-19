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
            $login = $_POST['login'];
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
            $login = $_POST['login'];
            $this->_userManager = new UserManager;
            if ($this->_userManager->userExist($login) === false) {
                $this->_userManager->updateLogin($login);
                echo 0;
            } else {
                echo 1;
            }
        }

        private function _resetPasswd() {
            $email = $_POST['email'];
            $this->_userManager = new UserManager;
            if ($this->_userManager->getConfirmKey($email) != null)
            {
                var_dump('ok');
                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"camagru.fr"<no-reply@camagru.fr>'."\n";
                $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                $message = '<a href="'. URL .'?url=register&submit=confirm&login='. $login .'&key='. $key .'">Confirm your account</a>';
                mail($email, "Camagru reset password", $message, $header);
                echo 0;
            } else {
                echo 1;
            }
        }
    }  
?>