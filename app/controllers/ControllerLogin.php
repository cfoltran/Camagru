<?php
    require_once('views/View.php');

    class ControllerLogin {
        private $_userManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'ok') {
                $this->_login();
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
                    $this->_view = new View('Camagru');
                    $this->_view->generate(array());
                }
            }
        }
    }  
?>