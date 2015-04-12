<?php
namespace Loyalty\Controller;

class Freebies {

    protected $app;

    public function __construct(&$app) {
        $this->app = $app;
        $app->get('/freebies/:id', array($this, 'freebies'));
        /*
        $app->post('/search/getcustomers', array($this, 'getCustomers'));
        $app->get('/search/getcustomers', array($this, 'getCustomers'));
        $app->get('/customers/add', array($this, 'add'));
        $app->post('/customers/add', array($this, 'add_post'));
        $app->get('/customers/edit/:id', array($this, 'edit'));
        $app->post('/customers/edit/:id', array($this, 'edit_post'));
         */
    }

    public function freebies($id) {
        $sql = "select FirstName, LastName, Points, Telephone, Email, Points from Customers " .
            "where CustomerID = :customerid;";
        $statement = $this->app->db->prepare($sql);
        $params = array('customerid' => $id);
        $queryComplete = $statement->execute($params);
        foreach($statement as $row){}
        $this->app->render('freebies.html', array('id' => $id, 'Customer' => $row));
    }
}
