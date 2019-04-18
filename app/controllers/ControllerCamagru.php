<?php
    class ControllerCamagru {
        private $_photoManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'pic') {
                $this->_catchPhoto();
            } else if ($_GET['submit'] === 'del') {
                $this->_dropPhoto();
            } else {
                $this->camagruView();
            }
        }

        public function camagruView() {
            session_start();
            if (isset($_SESSION['login'])) {
                $this->_photosManager = new PhotoManager;
                $photos = $this->_photosManager->getPhotosUser($_SESSION['id']);
                $_library = $photos;
                $this->_view = new View('Camagru');
                $this->_view->generate(array('photos' => $photos));
            } else {
                $this->_view = new View('Login');
                $this->_view->generate(array('err' => "You must be connect to access to this page"));
            }
        }

        private function _catchPhoto() {
            $img = $_POST['img'];
            if (strpos($img, 'data:image/png;base64') === 0) {
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $this->_photoManager = new PhotoManager;
                $userManager = new UserManager;
                session_start();
                $this->_photoManager->addImage($img, $_SESSION['id']);
            }
        }

        private function _dropPhoto() {
            $id_photo = $_POST['idPhoto'];
            $this->_photoManager = new PhotoManager;
            $this->_photoManager->dropPhoto($id_photo);
        }
    }
?>