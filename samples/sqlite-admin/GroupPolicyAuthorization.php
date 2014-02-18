<?php

use oopapi\Authorization;
use oopapi\AuthorizationException;

class GroupPolicyAuthorization extends Authorization {
    private static $TABLE_ACL   = ['admin' => ['user', 'log'],
                                   'guest' => ['user']];
    private static $COMMAND_ACL = ['admin' => ['select', 'insert', 'update', 'delete'],
                                   'guest' => ['select']];

    protected function handle() {
        $user    = HttpBasicAuthentication::getUser();
        $group   = (new DbUser)->getGroup($user);
        $table   = HttpGetRequest::getTable();
        $command = HttpGetRequest::getCommand();
        if (empty($group)) {
            throw new AuthorizationException('Access rejected for users without group');
        }
        if (!in_array($table, self::$TABLE_ACL[$group])) {
            throw new AuthorizationException("Access rejected to table '$table' for users of group '$group'");
        }
        if (!in_array($command, self::$COMMAND_ACL[$group])) {
            throw new AuthorizationException("Permission denied to invoke command '$command' for users of group '$group'");
        }
    }
    
    protected function pass($retval) {
        (new DbLog)->log('Access granted');
        parent::pass($retval);
    }
    
    protected function fail(\Exception $e) {
        (new DbLog)->log($e);
    }
}