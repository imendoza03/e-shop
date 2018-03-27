<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userName = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    
    $userNameHasError = (strlen($userName) < 3);
    $passwordHasError = (strlen($password) < 5);
    
    if (!$userNameHasError && !$passwordHasError) {
        $userExists = verifyUser($username ?? '', $password ?? '');
        
        if(!$userExists) {
            echo 'Either the username or password does not exist';
            return;
        }
        
        if(!session_start()) {
           echo 'Session could not be started.';
        }
        
        $_SESSION['user'] = $userName;
        $_SESSION['date'] = new DateTime('now');
        $_SESSION['isLogged'] = true;
        
        var_dump($_SESSION);
        die;
        
        redirect("home.php");
    }
    
}

function redirect($url) {
    header('location:' . $url);
    exit();
}

function verifyUser($username, $password){
    
    $dbConnection = startDbConnection();
    $statement = 'SELECT * FROM USERS WHERE username=:username AND password=:password';
    $preparedQuery = $dbConnection->prepare($statement);
    
    if($preparedQuery) {
        $preparedQuery->bindValue('username', $username);
        $preparedQuery->bindValue('password', hash('sha256', $password));
        
        if(!$preparedQuery->execute()) {
            echo 'User has not found in the db';
            return;
        }
        
        $user = $preparedQuery->fetch();
        
        if(!$user){
           return false;
        }
        
        return true;
    }
}

function startDbConnection() {
    try {
        $connection = new \PDO('mysql:host=localhost;dbname=eshop', 'root');
    } catch (PDOException $e) {
        echo $e->getMessage();
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
	<nav>
	    <ul class="menu">
	      <li><a href="/index.php">E-Shop</a></li>
	      <li><a href="/registration.php">Register</a></li>
	    </ul>
  	</nav>
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