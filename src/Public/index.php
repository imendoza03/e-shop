<?php

require_once '../Core/AbstractController.php';

class IndexController extends AbstractController
{
    
    protected $articles;
    
    public function loadArticles()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            
           $dbConnection = $this->getConnection();
           $statement = 'SELECT name, description, image FROM articles';
           
           $preparedQuery = $dbConnection->prepare($statement);
           
           if(!$preparedQuery){
               $errorMessage = 'Sql statement could not be prepared';
               include '../Templates/error.php';
               die();
           }
           
           if(!$preparedQuery->execute()) {
               $errorMessage = 'Query could not be executed!';
               include '../Templates/error.php';
               die();
           }
           
           $this->articles = $preparedQuery->fetchAll(PDO::FETCH_CLASS);
        }
        
    }
    
    public function getArticles(){
        return $this->articles;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $controller = new IndexController();
    $controller->loadArticles();
    $articles = $controller->getArticles();
    
    include '../Templates/index.php';
}




