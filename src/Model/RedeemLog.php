<?php

namespace Loyalty\Model;

class RedeemLog {
    protected $_table = "RedeemLog";
    protected $_id;
    var $Time;
    var $User;
    var $Point;

    public function __construct($User, $Point) {
        $this->Time = $Time;
        $this->User = $User;
        $this->Point = $Point;
    }

    public static function Hydrate($id, $Time, $User, $Point) {
        $result = new RedeemLog($Time, $User, $Point);
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
