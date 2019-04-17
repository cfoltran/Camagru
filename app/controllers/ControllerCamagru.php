<?php
    class ControllerCamagru {
        private $_photoManager;
        private $_view;

        public function __construct($url) {
            if (isset($url) && count($url) > 1) {
                throw new Exception('Page not found');
            } else if ($_GET['submit'] === 'pic') {
                $this->_catchPic();
            } else {
                $this->camagruView();
            }
        }

        public function camagruView() {
            $this->_view = new View('Camagru');
            $this->_view->generate(array());
        }

        private function _catchPic() {
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
    }
?>