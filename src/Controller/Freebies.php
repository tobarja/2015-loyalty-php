<?php
namespace Loyalty\Controller;
use \Loyalty\Datalayer\RedeemLogRepository;
use \Loyalty\Datalayer\CustomerRepository;

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
        $CustomerRepository = new CustomerRepository($this->app->db);
        $Customer = $CustomerRepository->Get($id);
        if ($Customer->id() == null) {
            $this->app->redirect('/search');
        }
        $this->app->render('freebies.html', array('id' => $id, 'Customer' => $Customer));
    }

    public function calculateAdd() {
        $this->app->requiresLogin;
        $CustomerRepository = new CustomerRepository($this->app->db);
        $CustomerID = $this->app->request->post('customerid');
        $Customer = $CustomerRepository->Get($CustomerID);
        $redeem=null;

        $redeem = $_POST['redeem'];

        $additionalPoints = $this->app->request->post('updatenum');
        if (!is_numeric($additionalPoints)) {
            return false;
        }

        $Customer->Points = $Customer->Points + $additionalPoints;

        $queryComplete = $CustomerRepository->Save($Customer);

        if($redeem=="redeem"){
            $RedeemLogRepository = new RedeemLogRepository($this->app->db);
            $RedeemLog = new \Loyalty\Model\RedeemLog($_SESSION["UserName"], -1);
            $RedeemLogRepository->Save($RedeemLog);
        }

        if($queryComplete){
            $Customer = $CustomerRepository->Get($CustomerID);
            echo $Customer->Points;
        }
        else {
            echo "0 results";
        }
    }


    public function calculateSubtract() {
        $this->app->requiresLogin;
        $CustomerRepository = new CustomerRepository($this->app->db);
        $CustomerID = $this->app->request->post('customerid');
        $Customer = $CustomerRepository->Get($CustomerID);
        $redeem=null;

        $redeem = $_POST['redeem'];

        $subtractingPoints = $this->app->request->post('updatenum');
        if (!is_numeric($subtractingPoints)) {
            return false;
        }

        $Customer->Points = $Customer->Points - $subtractingPoints;

        $queryComplete = $CustomerRepository->Save($Customer);

        if($redeem=="redeem"){
            $RedeemLogRepository = new RedeemLogRepository($this->app->db);
            $RedeemLog = new \Loyalty\Model\RedeemLog($_SESSION["UserName"], 1);
            $RedeemLogRepository->Save($RedeemLog);
        }

        if($queryComplete){
            $Customer = $CustomerRepository->Get($CustomerID);
            echo $Customer->Points;
        }
        else {
            echo "0 results";
        }
    }
}
