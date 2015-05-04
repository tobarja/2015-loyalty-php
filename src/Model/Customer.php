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
    var $Donor;
    protected $LastActive;

    public function __construct($FirstName, $LastName, $Telephone, $Email, $Points, $Donor) {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Telephone = $Telephone;
        $this->Email = $Email;
        $this->Points = $Points;
        $this->Donor = $Donor;
    }

    public static function Hydrate($id, $FirstName, $LastName, $Telephone, $Email, $Points, $Donor, $LastActive) {
        $result = new Customer($FirstName, $LastName, $Telephone, $Email, $Points, $Donor);
        $result->_id = $id;
        $result->LastActive = $LastActive;
        return $result;
    }

    public function id() {
        return $this->_id;
    }

    public function table() {
        return $this->_table;
    }

    public function lastActive() {
        return $this->LastActive;
    }
}
