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