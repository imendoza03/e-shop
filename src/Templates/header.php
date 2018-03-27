<?php if (empty($_SESSION['username'])){?>
<header>
    <ul class="menu">
          <li><a href="index.php">E-Shop</a></li>
          <li><a class="login-button" href="login.php">Login</a></li>
          <li><a href="registration.php">Register</a></li>
	</ul>
</header>
<?php } else{?>
<header>
    <ul class="menu">
        <li><a href="index.php">E-Shop</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</header>
<?php }?>