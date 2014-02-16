<?php

namespace oopapi;

class AuthenticationException extends \Exception {
    public function __construct($message = 'Authentication failed') {
        parent::__construct($message);
    }
}