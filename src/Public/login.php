<?php

require_once '../Core/AbstractController.php';

class LoginController extends AbstractController
{
    public function processRequest()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $userName = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            
            if ($userName && $password) {
                
                $userExists = $this->verifyUser($userName ?? '', $password ?? '');
                
                if(!$userExists) {
                    $error = 404;
                    $errorMessage ='Either the username or password does not exist';
                    include '../Templates/error.php';
                    return;
                }
                
                session_start();
                $_SESSION['username'] = $userName;
                
                $this->redirect('index.php');
                die();
            }
            
        }
        
        include '../Templates/login.php';
    }
    
    function verifyUser($username, $password)
    {
        $dbConnection = $this->getConnection();
        $statement = 'SELECT password FROM users WHERE username=:username';
        $preparedQuery = $dbConnection->prepare($statement);
        
        if($preparedQuery) {
            $preparedQuery->bindValue('username', $username);
            
            if(!$preparedQuery->execute()) {
                $error = 404;
                $errorMessage ='User has not found in the db';
                include 'error.php';
                die();
            }
            
            $user = $preparedQuery->fetch();
            
            if($user){
                $hashedPassword = $user['password'];
                
                if(!password_verify($password, $hashedPassword)){
                    return false;
                }
                
                return true;
            }
        }
    }
}

$controller = new LoginController();
$controller->processRequest();


