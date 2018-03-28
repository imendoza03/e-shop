<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="/css/home.css" />
  <link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
  <?php include 'header.php'?>
  <main>
   <section class="articles">
	   <ul>
	   	<?php foreach($articles as $article) {?>
		   <li class="article">
		   	<img src="<?php echo $article['image'];?>" alt="first sneaker">
		   	<a href="/product-detail.php?id=<?php echo $article['id'];?>">Details</a>
		   </li>
		 <?php }?>
	   </ul>
   </section>
  </main>
  <footer>
  </footer>
</body>
</html>
