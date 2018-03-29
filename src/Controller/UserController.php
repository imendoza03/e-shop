<?php
namespace Controller;

use Core\AbstractController;

class UserController extends AbstractController
{
    public function registrationAction() {
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
                    
                    $this->redirect('login');
                }
            }
        }
        
        include '../Templates/registration.php';
    }
    
    public function loginAction() {
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
                
                $this->redirect('home');
                die();
            }
            
        }
        
        include '../Templates/login.php';
    }
    
    public function logoutAction() {
        session_start();
        $_SESSION = [];
        session_destroy();
        $this->redirect('login');
    }
    
    private function verifyUser($username, $password)
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

