<?php
    require_once('views/View.php');

    class ControllerLogin {
        private $_loginManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            }
            else
                $this->loginView();
        }

        public function loginView() {
            $this->_view = new View('Login');
            $this->_view->generate(array());
        }
    }  
?>