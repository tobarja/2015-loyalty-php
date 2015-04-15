<?php
namespace Loyalty;

class LoyaltyView extends \Slim\Views\Twig {
    public function render($template, $data = array()) {
        $env = $this->getEnvironment();
        $env->addGlobal("session", $_SESSION);
        return parent::render($template, $data);
    }
}
