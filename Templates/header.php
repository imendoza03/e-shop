<?php if (empty($_SESSION['username'])){?>
<header>
    <ul class="menu">
          <li><a href="home.php">E-Shop</a></li>
          <li><a class="login-button" href="login.php">Login</a></li>
          <li><a href="registration.php">Register</a></li>
	</ul>
</header>
<?php } else{?>
<header>
    <ul class="menu">
        <li><a href="home.php">E-Shop</a></li>
        <li><a href="create-article.php">Create Article</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</header>
<?php }?>