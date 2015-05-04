<?php

namespace Loyalty\Model;

class Customer {
    protected $_table = "Customers";
    protected $_id;
    var $FirstName;
    var $LastName;
    var $Telephone;
    var $Email;
    var $Points;

    public function __construct($FirstName, $LastName, $Telephone, $Email, $Points) {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Telephone = $Telephone;
        $this->Email = $Email;
        $this->Points = $Points;
    }

    public static function Hydrate($id, $FirstName, $LastName, $Telephone, $Email, $Points) {
        $result = new Customer($FirstName, $LastName, $Telephone, $Email, $Points);
        $result->_id = $id;
        return $result;
    }

    public function id() {
        return $this->_id;
    }

    public function table() {
        return $this->_table;
    }
}
