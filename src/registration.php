<?php

// $userNameHasError = false;
// $fullNameHasError = false;
// $passwordHasError = false;
// $confirmHasError = false;
// $userIsCreated = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userName = $_POST['reg-username'] ?? null;
    $fullName = $_POST['reg-fullname'] ?? null;
    $password = $_POST['reg-password'] ?? null;
    $confirmationPassword = $_POST['reg-password-confirm'] ?? null;
    
    $userNameHasError = (strlen($userName) < 3);
    $fullNameHasError = (strlen($fullName) < 3);
    $passwordHasError = (strlen($password) < 5);
    $confirmHasError = ($confirmationPassword != $password);
    
    if (!$userNameHasError && !$fullNameHasError && !$passwordHasError) {
        $dbConnection = startDbConnection();
        $statement = 'INSERT INTO USERS(username, name, password) VALUES(:username, :name, :password)';
        
        $preparedQuery = $dbConnection->prepare($statement);
        
        if($preparedQuery) {
            $preparedQuery->bindValue('username', $userName);
            $preparedQuery->bindValue('name', $fullName);
            $preparedQuery->bindValue('password', hash('sha256', $password));
            
            $userCreated = true;
            
            if(!$preparedQuery->execute()) {
                echo 'Insertion error';
                return;
            }
        }
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
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="/css/common.css" />
  <link rel="stylesheet" type="text/css" href="/css/registration.css" />
</head>
<body>
	<nav>
	    <ul class="menu">
	      <li><a href="/index.php">E-Shop</a></li>
	      <li><a href="/login.php">Login</a></li>
	    </ul>
  	</nav>
    <main>
    	<h2 class="title">Registration</h2>
        <form action="/registration.php" method="POST">
            <label for="reg-username">Username: </label>
        	<input type="text" name="reg-username" placeholder="enter user name..." value="<?php if($userNameHasError ?? false){echo htmlentities($userName ?? '');}?>"/>
        	
        	<?php if($userNameHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Username has error, it must have a minimum lenght of 2' . '</p>';
        	}?>
        	
        	<label for="reg-fullname">Name: </label>
        	<input type="text" name="reg-fullname" placeholder="enter name..." value="<?php if($fullNameHasError ?? false){echo htmlentities($fullName ?? '');}?>"/>
        	
        	<?php if($fullNameHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Name has error, it must have a minimum lenght of 2' . '</p>';
        	}?>
        	
        	<label for="reg-password">Password: </label>
        	<input type="password" name="reg-password" placeholder="enter user password..." value="<?php if($passwordHasError ?? false){ echo htmlentities($password ?? '');}?>"/>
        	<label for="reg-password-confirm">Confirm password: </label>
        	<input type="password" name="reg-password-confirm" placeholder="enter user confirmation password..." value="<?php if($confirmHasError ?? false){echo htmlentities($confirmationPassword ?? '');}?>"/>
        	
        	<?php if($passwordHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Password has error, it must have a minimum lenght of 5' . '</p>';
        	}?>
        	<button type="submit">Register</button>
        	
        	<?php if($userCreated ?? false) {
        	    echo "<p class='has-success'>" . "User has been created!" . '</p>';
        	}?>
        </form>
    </main>
</body>
</html>