<?php

namespace oopapi;

class Authentication extends RequestHandler {
    protected function invoke() {
        throw new AuthenticationException();
    }
}