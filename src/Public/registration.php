<?php

require_once '../Core/AbstractController.php';

class RegistrationController extends AbstractController
{
    public function processRequest()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $userName = $_POST['reg-username'] ?? null;
            $fullName = $_POST['reg-fullname'] ?? null;
            $password = $_POST['reg-password'] ?? null;
            $confirmationPassword = $_POST['reg-password-confirm'] ?? null;
            
            $userNameHasError = (strlen($userName) < 3);
            $fullNameHasError = (strlen($fullName) < 3);
            $passwordHasError = (strlen($password) < 5);
            $confirmHasError = ($confirmationPassword != $password);
            
            if (!($userNameHasError && $fullNameHasError && $passwordHasError)) {
                $dbConnection = $this->getConnection();
                $statement = 'INSERT INTO USERS(username, name, password) VALUES(:username, :name, :password)';
                
                $preparedQuery = $dbConnection->prepare($statement);
                
                if($preparedQuery) {
                    $preparedQuery->bindValue('username', $userName);
                    $preparedQuery->bindValue('name', $fullName);
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $preparedQuery->bindValue('password', $hashedPassword);
                    
                    if(!$preparedQuery->execute()) {
                        echo 'Insertion error';
                        return;
                    }
                    
                    $userCreated = true;
                    
                    $this->startSession();
                    $_SESSION['username'] = $userName;
                    
                    $this->redirect('login.php');
                }
            }
        }
        
        include '../Templates/registration.php';
    }
}

$controller = new RegistrationController();
$controller->processRequest();




