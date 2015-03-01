<?php

namespace Loyalty;

class Home {

    public function __construct(&$app) {
        $app->get('/', array($this, 'home'))->name('home');
    }

    public function home() {
        echo "Hello World";
    }
}
