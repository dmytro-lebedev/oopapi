<?php

namespace oopapi;

class NonInvokableException extends \Exception {
    protected $class;
    
    public function __construct($class) {
        $this->class = $class;
        parent::__construct("Class $class does not implement interface Invokable");
    }
    
    public function getClass() {
        return $this->class;
    }
}