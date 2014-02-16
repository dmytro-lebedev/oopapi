<?php

namespace oopapi;

class Authorization extends RequestHandler {
    protected function invoke() {
        throw new AuthorizationException();
    }
}