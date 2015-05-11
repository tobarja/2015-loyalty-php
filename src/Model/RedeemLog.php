<?php
namespace Loyalty\Model;

class RedeemLog {
    protected $_table = "RedeemLog";
    protected $_id;
    var $Time;
    var $Customer;
    var $User;
    var $Point;

    public function __construct($Customer, $User, $Point) {
        $this->Customer = $Customer;
        $this->User = $User;
        $this->Point = $Point;
    }

    public static function Hydrate($id, $Time, $Customer, $User, $Point) {
        $result = new RedeemLog($Time, $Customer, $User, $Point);
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
