<?php

session_start();

require_once("./Autoload.php");
require_once("./Config.php");
require_once("./EndPoint.php");
require_once("../Z_Moldes/core/recursos/debug.php");
require_once("../Z_Moldes/core/arquitetura/Web_request.php");
$router = new EndPoint;
$router->route();


