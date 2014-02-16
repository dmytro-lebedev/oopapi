<?php

namespace oopapi;

abstract class Authentication extends RequestHandler {
    public function __invoke() {
        if ($this->authenticated()) {
            $this->pass();
        }
        else {
            $this->fail();
        }
    }
    
    abstract function authenticated();

    public function pass() {
        parent::__invoke();
    }
    
    public function fail() {}
}