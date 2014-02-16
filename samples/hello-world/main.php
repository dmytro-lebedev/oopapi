<?php

require_once '../../src/oopapi.php';
require_once 'NoAuthentication.php';
require_once 'NoAuthorization.php';
require_once 'HelloWorldInvokation.php';
require_once 'HelloWorld.php';

$handlers = new NoAuthentication(
            new NoAuthorization(
            new HelloWorldInvokation()));
$handlers();