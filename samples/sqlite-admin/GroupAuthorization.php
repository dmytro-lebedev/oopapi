<?php

use oopapi\Authorization;
use oopapi\AuthorizationException;

class GroupAuthorization extends Authorization {
    protected function handle() {
        if (empty(DbUser::getGroup(BasicHttpAuthentication::getUser()))) {
            throw new AuthorizationException('User is not a member of any group');
        }
    }
    
    protected function pass($retval) {
        DbLog::log('Authorized successfully');
        parent::pass($retval);
    }
    
    protected function fail(\Exception $e) {
        DbLog::log($e);
    }
}