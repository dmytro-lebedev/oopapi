<?php

namespace oopapi;

class Authentication extends RequestHandler {
    protected function handle() {
        throw new AuthenticationException();
    }
}