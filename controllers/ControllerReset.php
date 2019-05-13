<?php
    require_once('views/View.php');

    class ControllerReset {
        private $_userManager;
        private $_photosManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] == 'reset') {
                $this->_reset();
            } else if ($_GET['submit'] == 'mail') {
                $this->_updateMail();
            } else {
                $this->_resetView();
            }
        }

        private function _resetView() {
            $this->_view = new View('Reset');
            $this->_view->generate(array());
        }

        private function _reset() {
            $passwd1 = $_POST['passwd1'];
            $passwd2 = $_POST['passwd2'];
            $key = $_POST['key'];
            if ($passwd1 !== $passwd2) {
                $err = "Passwords doesn't match";
                $this->_view = new View('Reset');
                $this->_view->generate(array('err' => $err));
            } 
            else if (!preg_match('/^(?=.*[^\w])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $passwd1) || strlen($passwd1) < 8) {
                $err = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
                $this->_view = new View('Reset');
                $this->_view->generate(array('err' => $err));
                return;
            } else {
                // Hash the user password
                $newKey = '';
                for ($i = 0; $i < 14; $i++) {
                    $newKey .= mt_rand(0, 9);
                }
                $hash = hash('whirlpool', $passwd1);
                $this->_userManager = new UserManager;
                $this->_userManager->resetPasswd($hash, $key, $newKey);
                $this->_view = new View('Login');
                $this->_view->generate(array('info' => "Your password has been reset"));
            }
        }

        private function _updateMail() {
            $this->_userManager = new UserManager;
            $this->_userManager->updateMailById($_GET['id'], urldecode($_GET['mail']));
            $this->_view = new View('Login');
            $this->_view->generate(array('info' => "Your email has been reset"));
        }
    }
?>