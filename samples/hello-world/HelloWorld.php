<?php

use oopapi\Invokable;

class HelloWorld implements Invokable {
    private $message;
    
    public function __construct() {
        $this->message = 'Hello World!';
    }

    public function __invoke() {
        echo $this->message;
    }
}