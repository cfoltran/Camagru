<?php
class User {
    private $_id;
    private $_firstname;
    private $_lastname;

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

    public function setFirstname($firstname) {
        if (is_string($firstname)) {
            $this->_firstname = $firstname;
        }
    }
}