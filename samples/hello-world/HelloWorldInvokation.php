<?php

use oopapi\Invokation;

class HelloWorldInvokation extends Invokation {
    protected function getClass() {
        return 'HelloWorld';
    }
}