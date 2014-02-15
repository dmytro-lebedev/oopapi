<?php

namespace oopapi;

class Invokation extends RequestHandler {
    const CLASS_VARIABLE = '__CLASS__';
    private $class;

    public function __construct(RequestHandler $successor = NULL) {
        parent::__construct($successor);
        $this->class = $_POST[self::CLASS_VARIABLE];
    }

    public function __invoke() {
        $object = new $this->class;
        if ($object instanceof Invokable) $object();
    }
}