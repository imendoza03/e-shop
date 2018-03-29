<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="/css/product-detail.css" />
  <link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
	<?php include 'header.php'?>
    <main>
        <?php if(!empty($article)) {?>
        <section>
        	<form action="/article/addToCart" method="POST">
            	<article>
        			<img src="<?php echo $article['image']?>">
        			<button type="submit">Add to cart</button>
            	</article>
        	</form>
        	<span><?php echo $article['description']?></span>
        </section>
        <?php }?>
    </main>
</body>