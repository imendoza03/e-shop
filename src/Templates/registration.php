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
	<?php include 'header.php'?>
    <main>
    	<h2 class="title">Registration</h2>
        <form action="/registration.php" method="POST">
            <label for="reg-username">Username: </label>
        	<input type="text" name="reg-username" placeholder="enter user name..." value="<?php if($userNameHasError ?? false){echo htmlentities($userName ?? '');}?>"/>
        	
        	<?php if($userNameHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Username has error, it must have a minimum length of 2' . '</p>';
        	}?>
        	
        	<label for="reg-fullname">Name: </label>
        	<input type="text" name="reg-fullname" placeholder="enter name..." value="<?php if($fullNameHasError ?? false){echo htmlentities($fullName ?? '');}?>"/>
        	
        	<?php if($fullNameHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Name has error, it must have a minimum length of 2' . '</p>';
        	}?>
        	
        	<label for="reg-password">Password: </label>
        	<input type="password" name="reg-password" placeholder="enter user password..." value="<?php if($passwordHasError ?? false){ echo htmlentities($password ?? '');}?>"/>
        	<label for="reg-password-confirm">Confirm password: </label>
        	<input type="password" name="reg-password-confirm" placeholder="enter user confirmation password..." value="<?php if($confirmHasError ?? false){echo htmlentities($confirmationPassword ?? '');}?>"/>
        	
        	<?php if($passwordHasError ?? false) {
        	    echo "<p class='input-has-error'>" . 'Password has error, it must have a minimum length of 5' . '</p>';
        	}?>
        	<button type="submit">Register</button>
        	
        	<?php if($userCreated ?? false) {
        	    echo "<p class='has-success'>" . "User has been created!" . '</p>';
        	}?>
        </form>
    </main>
</body>
</html>