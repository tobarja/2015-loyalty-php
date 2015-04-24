<?php
namespace Loyalty\Controller;

class Accounting {

    protected $app;

    public function __construct(&$app) {
        $this->app = $app;
        $app->get('/accounting', array($this, 'accounting'));
        $app->get('/accounting/view/:year/:month', array($this, 'view'));
        $app->post('/accounting/deleteAll', array($this, 'deleteAll'));
    }

    public function accounting() {
        $this->app->requiresAdmin;
        $sql = "select sum(Point) as 'Points' from RedeemLog";
        $statement = $this->app->db->prepare($sql);
        $queryComplete = $statement->execute();
        $totalrow = $statement->fetch(\PDO::FETCH_ASSOC);

        $sql = "select year(Time) as Year, month(Time) as Month from RedeemLog group by year(Time), month(Time);";
        $statement = $this->app->db->prepare($sql);
        $queryComplete = $statement->execute();
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $this->app->render('accounting.html', array('totalPointsFromRedeemLog' => $totalrow['Points'],
            'redeemlog' => $rows));
    }

    public function view($year, $month) {
        $this->app->requiresAdmin;
        $sql = "select Time,User,Point from RedeemLog where month(Time) = :Month and year(Time) = :Year;";
        $statement = $this->app->db->prepare($sql);
        $queryComplete = $statement->execute(array('Year' => $year, 'Month' => $month));
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $this->app->render('accounting-view.html', array('data' => $rows));
    }

    public function deleteAll() {
        $this->app->requiresAdmin;
        $sql = "delete from RedeemLog where 1=1";
        $statement = $this->app->db->prepare($sql);
        $queryComplete = $statement->execute();

        if ($queryComplete){
            echo "<h1>You have deleted every entry in the redeem table</h1><br><h2>You will now be redirected...</h2>";
            header( "refresh:3;url=/accounting");
        }
        else {
            echo "Error: " .$sql. "<br>" . "PDO::errorInfo():\n";
            print_r($statement->errorInfo());
        }
    }
}
