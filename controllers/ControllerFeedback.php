<?php
    require_once('views/View.php');
    
    class ControllerFeedback {
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] == "feedback") {
                $this->send_feedback();
            } else {
                $this->feedback();
            }
        }

        private function feedback() {
            $this->_view = new View('Feedback');
            $this->_view->generate(array());
        }

        private function send_feedback() {
            $login = $_POST['login'];
            $feedback = $_POST['feedback'];
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"camagru.fr"<no-reply@camagru.fr>'."\n";
            $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $message = '<h1>' . $login . '</h1><br><br>';
            $message .= '<p>' . $feedback . '</p>';
            mail("clfoltra42@gmail.com", "Camagru feedback", $feedback, $header);
            $this->_view = new View('Feedback');
            $this->_view->generate(array('info' => "Thanks for your feedback"));

        }
    }
?>