<?php

namespace oopapi;

class Authorization extends RequestHandler {
    protected function handle() {
        throw new AuthorizationException();
    }
}