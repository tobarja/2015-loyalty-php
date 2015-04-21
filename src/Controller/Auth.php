<?php
namespace Loyalty\Controller;

class Auth {
    protected $app;

    public function __construct(&$app) {
        $this->app = $app;
        $app->get('/login', array($this, 'login'))->name('login');
        $app->post('/login', array($this, 'login_post'))->name('login');
        $app->get('/logout', array($this, 'logout'))->name('logout');

        $app->isLoggedIn = function () {
            return $this->isLoggedIn();
        };
        $app->isAdmin = function () {
            return $this->isAdmin();
        };

        $app->requiresLogin = function () {
            if (!$this->isLoggedIn()) {
                $this->app->redirect('/login');
            };
        };
        $app->requiresAdmin = function () {
            if (!$this->isAdmin()) {
                $this->logout();
            };
        };

    }

    public function login() {
        if ($this->isLoggedIn()) {
            $this->app->response->redirect('/search');
        }
        $this->app->render('login.html');
    }

    public function login_post() {
        $username = $this->app->request->post('userName');
        $password = $this->app->request->post('password');
        $pq = $this->app->db->prepare("select id, UserName, Admin, Password from Users where UserName = :username");
        $pq->execute(array('username' => $username));
        $row = $pq->fetch();
        if ($row !== FALSE) {
            if (password_verify($password, $row['Password'])) {
                $_SESSION['UserID'] = $row['id'];
                $_SESSION['UserName'] = $row['UserName'];
                $_SESSION['Admin'] = $row['Admin'];
            }
        }
        $this->app->response->redirect('/login');
    }

    private function isLoggedIn() {
        return (array_key_exists('UserID', $_SESSION));
    }

    private function isAdmin() {
        if (array_key_exists('Admin', $_SESSION)) {
            if ($_SESSION['Admin'] == 1) {
                return true;
            }
        }
        return false;
    }

    public function logout() {
        session_destroy();
        $this->app->redirect('/login');
    }
}
