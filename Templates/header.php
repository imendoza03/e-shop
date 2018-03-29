<?php if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
} if(empty($_SESSION['username'])){
?>
<header>
    <ul class="menu">
          <li><a href="/home">E-Shop</a></li>
          <li><a class="login-button" href="/login">Login</a></li>
          <li><a href="/registration">Register</a></li>
	</ul>
</header>
<?php } else{?>
<header>
    <ul class="menu">
        <li><a href="/home">E-Shop</a></li>
        <li><a href="/article/create">Create Article</a></li>
		<li><a href="/logout">Logout</a></li>
	</ul>
</header>
<?php }?>