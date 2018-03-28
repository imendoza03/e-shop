<?php
namespace Controller;

use Core\AbstractController;

class ArticleController extends AbstractController
{
    public function creationAction()
    {
        session_start();
        
        if (empty($_SESSION['username'])) {
            $errorCode = 403;
            $errorMessage = 'User must be logged in order to create articles!';
            include '../Templates/error.php';
            die();
        }
       
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $articleName = $_POST['article-name'] ?? null;
            $articleDescription = $_POST['article-description'];
            $articleImage = $_POST['article-image'];
            
            if(!empty($articleName) && !empty($articleName) && !empty($articleImage)) {
                $dbConnection = $this->getConnection();
                
                $statement= 'INSERT INTO articles(name, description, image) VALUES (:name, :description, :image);';
                
                $preparedQuery = $dbConnection->prepare($statement);
                
                if(!$preparedQuery){
                    $errorMessage = 'Sql statement could not be prepared';
                    include '../Templates/error.php';
                    die();
                }
                
                $preparedQuery->bindValue('name', $articleName);
                $preparedQuery->bindValue('description', $articleDescription);
                $preparedQuery->bindValue('image', $articleImage);
                
                if(!$preparedQuery->execute()) {
                    $errorMessage = 'Query could not be executed!';
                    include '../Templates/error.php';
                    die();
                }
                
                $this->redirect('index.php');
            }
        }
        
        include '../Templates/create-article.php';
    }
    
    public function detailAction() 
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $id = htmlentities($_GET['id']);
            
            $dbConnection = $this->getConnection();
            $statement = 'SELECT name, description, image FROM articles WHERE id=:id;';
            
            $preparedQuery = $dbConnection->prepare($statement);
            
            if(!$preparedQuery) {
                $errorMessage = 'Query was not correctly prepared.';
                include '../Templates/error.php';
            }
            
            $preparedQuery->bindValue('id', $id);
            
            if(!$preparedQuery->execute()){
                $errorMessage = 'Query was not correctly executed.';
                include '../Templates/error.php';
            }
            
            $article = $preparedQuery->fetch();
            
            if(!$article){
                $errorCode = 404;
                $errorMessage = 'This article does not exist';
                include '../Templates/error.php';
                die();
            }
            
            include '../Templates/product-detail.php';
        }
    }
    
    public function loadAction() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $dbConnection = $this->getConnection();
            $statement = 'SELECT id, name, description, image FROM articles';
            
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
            
            $articles = $preparedQuery->fetchAll();
            
            if(empty($articles)) {
                $errorMessage = 'No articles could be fetched';
                include '../Templates/error.php';
                die();
            }
            
            include '../Templates/index.php';
        }
    }
}

