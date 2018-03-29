<?php
namespace Controller;

use Core\AbstractController;

class ArticleController extends AbstractController
{
    public function createAction()
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
                
                $this->generatePreparationError($preparedQuery);
                
                $preparedQuery->bindValue('name', $articleName);
                $preparedQuery->bindValue('description', $articleDescription);
                $preparedQuery->bindValue('image', $articleImage);
                
                $this->generateExecutionError($preparedQuery);
                
                $this->redirect('home');
            }
        }
        
        include '../Templates/create-article.php';
    }
    
    public function detailAction() 
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $id = htmlentities($_GET['id']);
            
            $dbConnection = $this->getConnection();
            $statement = 'SELECT id, name, description, image FROM articles WHERE id=:id;';
            
            $preparedQuery = $dbConnection->prepare($statement);
            
            $this->generatePreparationError($preparedQuery);
            $preparedQuery->bindValue('id', $id);
            $this->generateExecutionError($preparedQuery);
            
            $article = $preparedQuery->fetch();
            
            if(!$article){
                $errorCode = 404;
                $errorMessage = 'This article does not exist';
                include '../Templates/error.php';
                die();
            }
            
            $articleId = $article['id'];
            
            include '../Templates/product-detail.php';
        }
    }
    
    public function loadAction() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $dbConnection = $this->getConnection();
            $statement = 'SELECT id, name, description, image FROM articles';
            
            $preparedQuery = $dbConnection->prepare($statement);
            
            $this->generatePreparationError($preparedQuery);
            $this->generateExecutionError($preparedQuery);
           
            $articles = $preparedQuery->fetchAll();
            
            if(empty($articles)) {
                $errorMessage = 'No articles could be fetched';
                include '../Templates/error.php';
                die();
            }
            
            include '../Templates/home.php';
        }
    }
    
    public function addToCartAction() 
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $dbConnection = $this->getConnection();
            
            $statement = 'SELECT id,description from articles WHERE id=:articleId';
            
            $preparedQuery = $dbConnection->prepare($statement);
            
            $this->generatePreparationError($preparedQuery);
            
            $preparedQuery->bindValue('articleId', $articleId);
            
            $this->generateExecutionError($preparedQuery);
            
            $article = $preparedQuery->fetch();
            
            if(!$article){
                $errorCode = 404;
                $errorMessage = 'This article does not exist';
                include '../Templates/error.php';
                die();
            }
            
            $articleId = $article['id'];
            $articleDescription = $article['desription'];
            
            $statement = 'INSET INTO cart(article_id, description) VALUES(:articleId, description);';
                
            $preparedQuery = $dbConnection->prepare($statement);
            
            $this->generatePreparationError($preparedQuery);
            
            $preparedQuery->bindValue('articleId', $articleId);
            $preparedQuery->bindValue('description', $articleDescription);
            
            $this->generateExecutionError($preparedQuery);
            
            $this->redirect('cart?id=' . $articleId);
        }
    }
    
    public function loadCartAction() 
    {
        $dbConnection = $this->getConnection();
        $statement = 'SELECT * FROM cart;';
        $preparedQuery = $dbConnection->prepare($statement);
        
        $this->generatePreparationError($preparedQuery);
        $this->generateExecutionError($preparedQuery);
        
        $cartArticles = $preparedQuery->fetchAll();
        
        if(empty($cartArticles)) {
            $errorMessage = 'There are no articles in the cart';
            include '../Templates/error.php';
            die();
        }
        
        include '../Templates/cart.php';
    }

    //Raises an error in case of query execution failure
    private function generateExecutionError($preparedQuery) {
        if(!$preparedQuery->execute()) {
            $errorMessage = 'Error executing query';
            include '../Templates/error.php';
            die();
        }
    }
    
    //Raises an error in case of query prepartion failure
    private function generatePreparationError($preparedQuery) {
        if(!$preparedQuery) {
            $errorMessage = 'Error preparing query';
            include '../Templates/error.php';
            die();
        }
    }
}

