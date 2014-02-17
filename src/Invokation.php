<?php

namespace oopapi;

abstract class Invokation extends RequestHandler {
    protected function handle() {
        $class  = $this->getClass();
        $object = new $class;
        if ($object instanceof Invokable) {
            return $object();
        }
        else {
            throw new NonInvokableException($class);
        }
    }
    
    abstract protected function getClass();
}