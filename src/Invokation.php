<?php

namespace oopapi;

class Invokation extends RequestHandler {
    const CLASS_VARIABLE = '__CLASS__';
    protected $class;

    public function __construct(RequestHandler $successor = NULL) {
        parent::__construct($successor);
        $this->class = $_POST[self::CLASS_VARIABLE];
    }

    protected function invoke() {
        $object = new $this->class;
        if ($object instanceof Invokable) {
            return $object();
        }
        else {
            throw new NonInvokableException($this->class);
        }
    }
}