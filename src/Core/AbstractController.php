<?php

namespace Core;

class AbstractController
{
    public function getConnection() 
    {
        try {
            return new \PDO('mysql:host=localhost;dbname=eshop', 'root');
        } catch (\PDOException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            include '../Templates/error.php';
            die();
        }
    }
    
    public function startSession()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    
    public function redirect($url) 
    {
        header('location:/' . $url);
        die();
    }
}