<?php

namespace oopapi;

class NonInvokableException extends \Exception {
    public function __construct($class) {
        parent::__construct("Class $class does not implement interface Invokable");
    }
}