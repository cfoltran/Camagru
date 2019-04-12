<?php
    require_once('views/View.php');
    
    class ControllerHome {
        private $_photosManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            }
            else
                $this->photos();
        }

        private function photos() {
            $this->_photosManager = new PhotoManager;
            $photos = $this->_photosManager->getPhotos();
            $this->_view = new View('Home');
            $this->_view->generate(array('photos' => $photos));
        }
    }
?>