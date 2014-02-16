<?php

namespace oopapi;

class AuthorizationException extends \Exception {
    public function __construct($message = 'Authorization failed') {
        parent::__construct($message);
    }
}