<?php

require_once __DIR__."/vendor/autoload.php";
require_once __DIR__."/config/config.php";
require_once __DIR__."/config/sessionHandler.php";

use src\Controller\{Home,Poll,Lga,Result};
use core\{Router,App};

$router = new Router();

$router->get("hello/",[Home::class,"index"]);

$router->get("/",[Poll::class,"index"]);
$router->post("getPollingUnitResults/",[Poll::class,"getUnitResult"]);
$router->get("getTotal/",[Lga::class,"getTotal"]);
$router->get("addScore/",[Result::class,"storePage"]);
$router->post("addScore/",[Result::class,"store"]);
$router->post("getTotal/",[Lga::class,"getTotal"]);

echo (new App($router))->render($_SERVER["REQUEST_METHOD"],$_SERVER["REQUEST_URI"]);