<?php
    require_once('views/View.php');

    class ControllerLogin {
        private $_userManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'login') {
                $this->_login();
            } else if ($_GET['submit'] === 'logout') {
                $this->_logout();
            } else {
                $this->loginView();
            }
        }

        public function loginView() {
            $this->_view = new View('Login');
            $this->_view->generate(array());
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
                    $this->_view = new View('Camagru');
                    $this->_view->generate(array());
                }
            }
        }

        private function _logout() {
            session_start();
            $login = $_SESSION['login'];
            $_SESSION['login'] = null;
            $this->_view = new View('Login');
            $this->_view->generate(array('info' => "See you <b>$login</b>"));
        }
    }  
?>