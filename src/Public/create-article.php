<?php

require_once '../Core/AbstractController.php';

class CreateArticleController extends AbstractController
{
    public function processRequest()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $articleName = $_POST['article-name'] ?? null;
            $articleDescription = $_POST['article-description'];
            $articleImage = $_POST['article-image'];
            
            if((strlen($articleName) && strlen($articleName) > 2) && !empty($articleImage)) {
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
    
}

$controller = new CreateArticleController();
$controller->processRequest();