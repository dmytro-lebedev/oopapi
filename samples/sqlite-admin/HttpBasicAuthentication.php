<?php

use oopapi\Authentication;
use oopapi\AuthenticationException;

class HttpBasicAuthentication extends Authentication {
    public function __destruct() {
        $this->logout();
    }

    private function logout() {
        unset($_SERVER['PHP_AUTH_USER']);
        unset($_SERVER['PHP_AUTH_PW']);
    }

    protected function handle() {
        if (empty($this->getUser())) {
            throw new AuthenticationException('Anonymous access forbidden');
        }
        if (!(new DbUser())->match($this->getUser(), $this->getPassword())) {
            throw new AuthenticationException('User/password do not match');
        }
    }
    
    public static function getUser() {
        return $_SERVER['PHP_AUTH_USER'];
    }
    
    private function getPassword() {
        return $_SERVER['PHP_AUTH_PW'];
    }

    protected function pass($retval) {
        (new DbLog)->log('Logged in');
        parent::pass($retval);
    }
    
    protected function fail(\Exception $e) {
        (new DbLog)->log($e);
        $this->login();
    }
    
    private function login() {
        header('WWW-Authenticate: Basic realm="Login"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Login required';
    }
}