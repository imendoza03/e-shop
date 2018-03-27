<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userName = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    
    if ($userName && $password) {
        
        $userExists = verifyUser($userName ?? '', $password ?? '');
        
        if(!$userExists) {
            $error = 404;
            $errorMessage ='Either the username or password does not exist';
            include 'error.php';
            return;
        }
        
        session_start();
        $_SESSION['username'] = $userName;
        
        header('location:/index.php');
        die();
    }
    
}

function verifyUser($username, $password){
    
    $dbConnection = startDbConnection();
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

function startDbConnection() {
    try {
        $connection = new \PDO('mysql:host=localhost;dbname=eshop', 'root');
    } catch (PDOException $e) {
        $error = $e->getCode();
        $errorMessage = $e->getMessage();
        include 'error.php';
        die();
    }
    
    return $connection;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="/css/common.css" />
  <link rel="stylesheet" type="text/css" href="/css/login.css" />
</head>
<body>
	<?php include 'header.php'?>
	<main>
	 	<form action="/login.php" method="POST">
	 		<label for="username">Username: </label>
	 		<input type="text" name="username" placeholder="enter user name..." value="<?php echo htmlentities($userName ?? '');?>">
	 
	 		<?php if($userNameHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Username has error, it must have a minimum length of 2' . '</p>';
        	}?>
      
	 		<label for="password">Password: </label>
	 		<input type="password" name="password" placeholder="enter password..." value="<?php echo htmlentities($password ?? '');?>"/>
	 		
	 		<?php if($passwordHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Password has error, it must have a minimum length of 5' . '</p>';
        	}?>
	 		<button type="submit">Login</button>
	 	</form>
	</main>
</body>
</html>