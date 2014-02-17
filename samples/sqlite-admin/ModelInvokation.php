<?php

use oopapi\Invokation;

class ModelInvokation extends Invokation {
    protected function getClass() {
        if (empty($this->getTable())) {
            throw new InvalidArgumentException('Empty table argument');
        }
        return $this->getModel();
    }
    
    private function getTable() {
        return $_GET['table'];
    }
    
    private function getModel() {
        return "Db{$this->getTable()}";
    }
}