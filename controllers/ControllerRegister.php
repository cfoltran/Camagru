<?php
    class ControllerRegister {
        private $_userManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'ok') {
                $this->_checks();
            } else if ($_GET['submit'] === 'confirm') {
                $this->_confirmAccount();
            } else {
                $this->registerView();
            }
        }

        public function registerView() {
            session_start();
            if ($_SESSION['login'] == null) {
                $this->_view = new View('Register');
                $this->_view->generate(array());
            } else {
                $this->_view = new View('Camagru');
                $this->_view->generate(array());
            }
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
                        // Let's add the little new
                $key = '';
                // Create the confirmation key for the mail
                for ($i = 0; $i < 14; $i++) {
                    $key .= mt_rand(0, 9);
                }
                $hash = hash('whirlpool', $passwd1);
                $this->_userManager->addUser($firstname, $lastname, $login, $mail, $hash, $key);
                $this->_sendConfirmationMail($login, $mail, $key);
                $this->_view = new View('Login');
                $this->_view->generate(array('info' => "Check your mailbox before signin"));
            }
        }

        private function _sendConfirmationMail($login, $mail, $key) {
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"camagru.fr"<no-reply@camagru.fr>'."\n";
            $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $message = '<a href="'. URL .'?url=register&submit=confirm&login='. $login .'&key='. $key .'">Confirm your account</a>';
            mail($mail, "Camagru account confirmation", $message, $header);
        }

        private function _confirmAccount() {
            $key = $_GET['key'];
            $login = $_GET['login'];

            $this->_userManager = new UserManager;
            if ($this->_userManager->checkConfKey($key, $login) === true) {
                $this->_userManager->confirmAccount($login, $key);
                $this->_view = new View('Login');
                $this->_view->generate(array('info' => "Confirmation success"));
            } else {
                $this->_view = new View('Login');
                $this->_view->generate(array('err' => "Oups an error occured"));
            }
        }
    }
?>