<?php
    class ControllerRegister {
        private $_userManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'ok') {
                $this->_checks();
            } else {
                $this->registerView();
            }
        }

        public function registerView() {
            $this->_view = new View('Register');
            $this->_view->generate(array());
        }

        private function _checks() {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $login = $_POST['login'];
            $mail = $_POST['mail'];
            $passwd1 = $_POST['passwd1'];
            $passwd2 = $_POST['passwd2'];
            $this->_userManager = new UserManager;
            // Ask to database if the user already exist
            $userExist = $this->_userManager->userExist($login);
            if ($userExist === true) {
                $err = "The user already exist, signin or change login";
                $this->_view = new View('Register');
                $this->_view->generate(array('err' => $err));
            } else if ($passwd1 !== $passwd2) {
                $err = "Passwords doesn't match";
                $this->_view = new View('Register');
                $this->_view->generate(array('err' => $err));
            } else {
                // Hash the user password
                $hash = hash('whirlpool', $passwd1);
                // Let's add the little new
                $key = '';
                // Create the confirmation key for the mail
                for ($i = 0; $i < 14; $i++) {
                    $key .= mt_rand(0, 9);
                }
                $this->_userManager->addUser($firstname, $lastname, $login, $mail, $hash, $key);
                // $this->_sendConfirmationMail($login, $mail, $key);
                $this->_view = new View('Login');
                $this->_view->generate(array('info' => "Check your mailbox before signin"));
            }
        }
    }
?>