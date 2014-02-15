<?php

namespace oopapi;

class Invokation extends RequestHandler {
    private $cls;

    public function __construct(RequestHandler $successor = NULL) {
        parent::__construct($successor);
        $this->cls = $_POST['__cls__'];
    }

    public function __invoke() {
        $obj = new $this->cls;
        if ($obj instanceof Invokable) $obj();
    }
}