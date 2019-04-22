<?php
    class ControllerPublication {
        private $_photosManager;
        private $_userManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['id']) {
                $this->_viewPublication();
            } else if ($_GET['submit'] === 'comment') {
                $this->_comment();
            } else {
                $this->registerView();
            }
        }

        private function _viewPublication() {
            $id_photo = $_GET['id'];
            $this->_photosManager = new PhotoManager;
            $photo = $this->_photosManager->getPhoto($id_photo);
            $this->_view = new View('Publication');
            $this->_view->generate(array(
                'pub' => $photo,
            ));
        }

        private function _comment() {
            session_start();
            $id_photo = $_POST['idPhoto'];
            $comment = $_POST['comment'];
            $login = $_POST['login'];
            $id_user = $_POST['idUser'];
            $id_user = $_SESSION['id'];
            if ($_SESSION['login'] === null) {
                var_dump('error');
            } else {
                $this->_photosManager = new PhotoManager;
                $this->_photosManager->comment($id_photo, $id_user, $comment);
                $this->_sendNotification($login, $id_user, $id_photo, $comment);
            }
        }

        private function _sendNotification($login, $id_user, $id_photo, $comment) {
            $this->_userManager = new UserManager;
            $mail = $this->_userManager->getMailById($id_user);
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"camagru.fr"<no-reply@camagru.fr>'."\n";
            $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $message = "<h1 style='color: rgb(21, 127, 251)'>". $login . " leave a comment on your publication</h1>";
            $message .= "<p>" . $comment . "</p>";
            $message .= "<a href=" . URL . "?url=publication&id=" . $id_photo . ">Go to the publication</a>";
            mail($mail, "Camagru new comment", $message, $header);
        }
    }
?>