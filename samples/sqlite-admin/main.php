<?php

require_once '../../src/oopapi.php';
require_once 'BasicHttpAuthentication.php';
require_once 'GroupAuthorization.php';
require_once 'ModelInvokation.php';
require_once 'Model.php';
require_once 'DbUser.php';
require_once 'DbLog.php';

$handlers = new BasicHttpAuthentication(
            new GroupAuthorization(
            new ModelInvokation()));
$handlers();