<?php

use oopapi\Invokable;

abstract class Model implements Invokable {
    protected $sqlite3;

    public function __construct() {
        $this->sqlite3 = new SQLite3('sqlite-admin.sqlite3');
    }
    
    public function __invoke() {
        $this->invokeCommand();
    }

    private function invokeCommand() {
        $this->{$this->getCommand()}();
    }

    private function getCommand() {
        return $_GET['command'];
    }
}