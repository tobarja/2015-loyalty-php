<?php
namespace Loyalty\Controller;

class Freebies {

    protected $app;

    public function __construct(&$app) {
        $this->app = $app;
        $app->get('/freebies/:id', array($this, 'freebies'));
        $app->post('/freebies/calculateAdd', array($this, 'calculateAdd'));
        $app->post('/freebies/calculateSubtract', array($this, 'calculateSubtract'));
    }

    public function freebies($id) {
        $this->app->requiresLogin;
        $sql = "select FirstName, LastName, Points, Telephone, Email, Points from Customers " .
            "where CustomerID = :customerid;";
        $statement = $this->app->db->prepare($sql);
        $params = array('customerid' => $id);
        $queryComplete = $statement->execute($params);
        $row = $statement->fetch();
        if ($row == FALSE) {
            $this->app->redirect('/search');
        }
        $this->app->render('freebies.html', array('id' => $id, 'Customer' => $row));
    }

    public function calculateAdd() {
        $this->app->requiresLogin;
        $redeem=null;

        $username = $_SESSION["UserName"];
        $redeem = $_POST['redeem'];
        $updatenum = $_POST['updatenum'];
        $customerid = $_POST['customerid'];

        $sql = "update Customers set Points = (Points + :updatenum) where CustomerID=:customerid;";
        $statement = $this->app->db->prepare($sql);

        $statement -> bindValue(':updatenum', $updatenum);
        $statement -> bindValue(':customerid', $customerid);

        $queryComplete = $statement->execute();

        if($redeem=="redeem"){
            $sql = "insert into RedeemLog (User,Point) values (:username,-1);";
            $statement = $this->app->db->prepare($sql);
            $statement -> bindValue(':username', $username);
            $statement->execute();
        }

        if($queryComplete){
            $sql = "select Points from Customers where CustomerID=:customerid;";
            $statement = $this->app->db->prepare($sql);

            $statement -> bindValue(':customerid', $customerid);
            $queryComplete = $statement->execute();
            $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach($rows as $row){ 
                echo $row['Points'];
            }
        }
        else {
            echo "0 results";
        }
    }


    public function calculateSubtract() {
        $this->app->requiresLogin;
        $redeem=null;

        $username = $_SESSION["UserName"];
        $redeem = $_POST['redeem'];
        $updatenum = $_POST['updatenum'];
        $customerid = $_POST['customerid'];

        $sql = "update Customers set Points = (Points - :updatenum) where CustomerID=:customerid;";
        $statement = $this->app->db->prepare($sql);

        $statement -> bindValue(':updatenum', $updatenum);
        $statement -> bindValue(':customerid', $customerid);

        $queryComplete = $statement->execute();

        if($redeem=="redeem"){
            $sql = "insert into RedeemLog (User,Point) values (:username,1);";
            $statement = $this->app->db->prepare($sql);
            $statement -> bindValue(':username', $username);
            $statement->execute();
        }

        if($queryComplete){
            $sql = "select Points from Customers where CustomerID=:customerid;";
            $statement = $this->app->db->prepare($sql);
            $statement -> bindValue(':customerid', $customerid);
            $queryComplete = $statement->execute();
            $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach($rows as $row){ 
                echo $row['Points'];
            }
        }
        else {
            echo "0 results";
        }
    }
}
