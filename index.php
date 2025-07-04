<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'config/autoload.php';
$router = new Router();
$router->handleRequest($_GET);
?>