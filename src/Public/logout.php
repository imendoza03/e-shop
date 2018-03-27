<?php 

require_once '../Core/AbstractController.php';

class LogoutController extends AbstractController
{
    public function processRequest()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('location:/login.php');
    }
}

$controller = new LogoutController();
$controller->processRequest();


