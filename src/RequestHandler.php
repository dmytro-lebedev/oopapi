<?php

namespace oopapi;

abstract class RequestHandler implements Invokable {
    private $successor;
    
    public function __construct(RequestHandler $successor = NULL) {
        $this->successor = $successor;
    }
    
    public function __invoke() {
        try {
            $retval = $this->handle();
        } catch (\Exception $e) {
            $this->fail($e);
            return;
        }
        $this->pass($retval);
    }
    
    abstract protected function handle();

    protected function pass($retval) {
        if (isset($this->successor)) {
            $this->successor->__invoke();
        }
    }
    
    protected function fail(\Exception $e) {
        throw $e;
    }
}