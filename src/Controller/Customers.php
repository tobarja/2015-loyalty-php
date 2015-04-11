<?php
namespace Loyalty\Controller;

class Customers {

    protected $app;

    public function __construct(&$app) {
        $this->app = $app;
        $app->get('/search', array($this, 'search'));
        $app->post('/search/getcustomers', array($this, 'getCustomers'));
        $app->get('/search/getcustomers', array($this, 'getCustomers'));
    }

    public function search() {
        $this->app->render('search.html');
    }

    public function getCustomers() {
        $searchString = $this->app->request->params('searchString');
        if (strlen($searchString) < 2) {
            return;
        }

        $sql = "select CustomerID, FirstName, LastName, Telephone, Points from Customers
            where CONCAT(FirstName, ' ', LastName) like :searchString 
            or LastName like :searchString 
            or Telephone like :searchString LIMIT 10";

        $statement = $this->app->db->prepare($sql);
        $params = array('searchString' => $searchString . '%');

        $statement->execute($params);
        if ($statement){
            foreach($statement as $row){
                $freebieUrl = "freebies?customerid=" . $row['CustomerID'];
                echo "<table><tr>" .
                "<td><a href='" . $freebieUrl . "'>" . $row["FirstName"] . " " . $row["LastName"] ."</a></td>" .
                "<td><a href='" . $freebieUrl . "'>" . $row["Telephone"]. "</a></td>" .
                "<td><a href='EditCustomer.php?customerid=".$row['CustomerID']."'>(Edit)</a></td>" .
                "</tr></table>";
            }
        }
    }
}
