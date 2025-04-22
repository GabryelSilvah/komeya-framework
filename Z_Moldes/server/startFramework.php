<?php
require_once("../../boot_system/Config.php");
require_once("./Autoload.php");
require_once("../../boot_system/StartApp.php");
require_once("../../boot_system/EndPoint.php");
require_once("../../Z_Moldes/core/resources/ToolsResponse.php");

use Komeya\app;
use Komeya\app\StartApp;
use Komeya\boot_system\EndPoint;
use Komeya\core\router\Web_request;

session_start();
$reflection = new ReflectionClass(StartApp::class);



$router = new EndPoint;
$router->route();
Web_request::start_route();
