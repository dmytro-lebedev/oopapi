<?php

namespace oopapi;

abstract class Invokation extends RequestHandler {
    protected function invoke() {
        $class  = $this->getClassName();
        $object = new $class;
        if ($object instanceof Invokable) {
            return $object();
        }
        else {
            throw new NonInvokableException($class);
        }
    }
    
    abstract protected function getClassName();
}