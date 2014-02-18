<?php

use oopapi\Invokable;

abstract class Model implements Invokable {
    protected $db;

    public function __construct() {
        $this->db = new SQLite3('./sqlite-admin.sqlite3');
        $this->create();
    }
    
    public function __invoke() {
        $this->invokeCommand();
    }

    private function invokeCommand() {
        $this->{HttpGetRequest::getCommand()}();
    }
    
    protected function echoResult(SQLite3Result $result) {
        while ($rec = $result->fetchArray(SQLITE3_ASSOC)) {
            print_r($rec);
            echo '<br>';
        }
    }

    abstract protected function create();
    abstract protected function select();
    abstract protected function insert();
    abstract protected function update();
    abstract protected function delete();
}