<?php
namespace Loyalty\Model;

class User {
    protected $_table = "Users";
    protected $_id;
    var $UserName;
    var $Password;
    var $Admin;

    public function __construct($UserName, $Password, $Admin) {
        $this->UserName = $UserName;
        $this->Password = $Password;
        $this->Admin = $Admin;
    }

    public static function Hydrate($id, $UserName, $Password, $Admin) {
        $result = new User($UserName, $Password, $Admin);
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
