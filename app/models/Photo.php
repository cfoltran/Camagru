<?php
class Photo {
    private $_id;
    private $_photo;
    private $_date;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            if (substr($key, 0, 2) == "id")
                $key = substr($key, 0, 2);
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    public function setId($id) {
        $id = (int) $id;
        if ($id > 0)
            $this->_id = $id;
    }

    public function setPhoto($photo) {
        if (is_string($photo)) {
            $this->_photo = $photo;
        }
    }

    public function setDate($date) {
        $this->_date = $date;
    }

    // Todo getters

    public function getPhoto() {
        return ($this->_photo);
    }
}
?>