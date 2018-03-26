<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="/css/login.css" />
  <link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
	<nav>
	    <ul class="menu">
	      <li><a href="/home.php">E-Shop</a></li>
	    </ul>
  	</nav>
	<main>
	 	<form action="/login.php" method="POST">
	 		<label for="username">Username: </label>
	 		<input type="text" name="username" placeholder="enter user name...">
	 		<label for="password">Password: </label>
	 		<input type="password" name="password" placeholder="enter password..."/>
	 		<button type="submit">Login</button>
	 	</form>
	</main>
</body>
</html>