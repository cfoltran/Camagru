<?php
    require_once('views/View.php');
    
    class ControllerHome {
        private $_photosManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'like') {
                $this->_like();
            } else
                $this->photos();
        }

        private function photos() {
            $this->_photosManager = new PhotoManager;
            $photos = $this->_photosManager->getPhotos();
            $this->_view = new View('Home');
            $this->_view->generate(array('photos' => $photos));
        }

        private function _like() {
            session_start();
            $id_photo = $_POST['idPhoto'];
            $id_user = $_SESSION['id'];
            if ($_SESSION['login'] === null) {
                $this->_view = new View('Login');
                $this->_view->generate(array("err" => "You must be connected to like a photo"));
            } else {
                $this->_photosManager = new PhotoManager;
                if ($this->_photosManager->alreadyLike($id_photo, $id_user) === false) {
                    $this->_photosManager->like($id_photo, $id_user);
                    var_dump("MERDE");die();
                } else {
                    $this->_photosManager->unlike($id_photo, $id_user);
                }
            }
        }
    }
?>