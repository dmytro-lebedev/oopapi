<?php

class HttpGetRequest {
    public static function getTable() {
        return Sqlite3::escapeString($_GET['table']);
    }
    
    public static function getCommand() {
        return Sqlite3::escapeString($_GET['command']);
    }
    
    public static function getUser() {
        return Sqlite3::escapeString($_GET['user']);
    }
    
    public static function getGroup() {
        return Sqlite3::escapeString($_GET['group']);
    }
    
    public static function getEmail() {
        return Sqlite3::escapeString($_GET['email']);
    }

    public static function getMessage() {
        return Sqlite3::escapeString($_GET['message']);
    }
}