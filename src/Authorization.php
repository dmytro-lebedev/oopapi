<?php

namespace oopapi;

abstract class Authorization extends RequestHandler {
    public function __invoke() {
        if ($this->authorized()) {
            $this->grant();
        }
        else {
            $this->reject();
        }
    }
    
    abstract public function authorized();
    
    public function grant() {
        parent::__invoke();
    }

    public function reject() {}
}