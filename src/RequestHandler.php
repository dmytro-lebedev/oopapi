<?php

namespace oopapi;

abstract class RequestHandler implements Invokable {
    private $successor;
    
    public function __construct(RequestHandler $successor = NULL) {
        $this->successor = $successor;
    }
    
    public function __invoke() {
        if (isset($this->successor)) {
            $this->successor();
        }
    }
}