<?php

require_once '../../src/oopapi.php';
require_once 'HttpGetRequest.php';
require_once 'HttpBasicAuthentication.php';
require_once 'GroupPolicyAuthorization.php';
require_once 'ModelInvokation.php';
require_once 'Model.php';
require_once 'DbUser.php';
require_once 'DbLog.php';

$handlers = new HttpBasicAuthentication(
            new GroupPolicyAuthorization(
            new ModelInvokation()));
$handlers();