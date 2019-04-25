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
            } else if ($_GET['submit'] === 'page') {
                $this->photos();
            } else {
                $this->_limit = 12;
                $this->photos();
            }
        }

        private function photos() {
            $this->_photosManager = new PhotoManager;
            $limit = ($_GET['n'] + 1) * 12;
            $photos = $this->_photosManager->getAllPhotos($limit);
            $pages = ceil($this->_photosManager->countPhotos() / 12);
            // var_dump($limit . "   " . $pages);die();
            $this->_view = new View('Home');
            $this->_view->generate(array(
                'photos' => $photos,
                'page' => ($limit < $pages * 12) ? $limit / 12 : $pages,
                'tpages' => $pages
            ));
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
                    echo 1;
                } else {
                    $this->_photosManager->unlike($id_photo, $id_user);
                    echo -1;
                }
            }
        }
    }
?>