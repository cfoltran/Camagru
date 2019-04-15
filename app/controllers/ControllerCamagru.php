<?php
    class ControllerCamagru {
        private $_camagruManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'pic') {
                var_dump('Pic recue');
                var_dump(base64_encode($_POST['pic']));die();
            } else {
                $this->camagruView();
            }
        }

        public function camagruView() {
            $this->_view = new View('Camagru');
            $this->_view->generate(array());
        }
    }
?>