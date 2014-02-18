<?php

use oopapi\Invokation;

class ModelInvokation extends Invokation {
    protected function getClass() {
        if (empty($this->getTable())) {
            throw new InvalidArgumentException('Empty table argument');
        }
        return $this->getModel();
    }
    
    private function getModel() {
        return "Db{$this->getTable()}";
    }
    
    private function getTable() {
        return ucfirst(HttpGetRequest::getTable());
    }
}