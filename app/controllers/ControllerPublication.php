<?php
    class ControllerPublication {
        private $_photosManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['id']) {
                $this->_viewPublication();
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
    }
?>