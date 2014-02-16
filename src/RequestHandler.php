<?php

namespace oopapi;

abstract class RequestHandler implements Invokable {
    private $successor;
    
    public function __construct(RequestHandler $successor = NULL) {
        $this->successor = $successor;
    }
    
    public function __invoke() {
        try {
            $retval = $this->invoke();
        } catch (Exception $e) {
            $this->fail($e);
            return;
        }
        $this->pass($retval);
    }
    
    abstract protected function invoke();

    protected function pass($retval) {
        if (isset($this->successor)) {
            $this->successor();
        }
    }
    
    protected function fail(\Exception $e) {
        throw $e;
    }
}