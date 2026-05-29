<?php
require_once __DIR__ . '/Config/requireconfig.php';
require_once __DIR__ . '/Router/Router.php';

use Router\Router; //aggiunto per modifica a Router.php

$router = new Router();
$router->dispatch();