<?php 

require_once '../vendor/autoload.php';

use Controller\UserController;

$controller = new UserController();
$controller->logoutAction();


