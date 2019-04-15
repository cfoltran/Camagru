<?php
    class ControllerCamagru {
        private $_camagruManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else {
                $this->camagruView();
            }
        }

        public function registerView() {
            $this->_view = new View('Camagru');
            $this->_view->generate(array());
        }
    }
?>