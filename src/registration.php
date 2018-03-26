<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registration</title>
</head>
<body>
    <main>
        <form action="/registration.php" method="POST">
            <label for="registration-username">Registration: </label>
        	<input type="text" name="registration-username" placeholder="enter user name..."/>
        	<label for="registration-fullname">Name: </label>
        	<input type="text" name="registration-fullname" placeholder="enter name..."/>
        	<label for="registration-password">Password: </label>
        	<input type="password" name="registration-password" placeholder="enter user password..."/>
        	<label for="registration-password">Confirm password: </label>
        	<input type="password" name="registration-password" placeholder="enter user confirmation password..."/>
        </form>
    </main>
</body>
</html>