<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="/css/cart.css" />
  <link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
  <section>
  <?php foreach ($cartArticles as $cartArticle) {?>
  	<span><?php echo $cartArticle['description']?></span>
  	<span>
  	<select>
  		<?php for($i=0;$i<=10;$i++) { ?>
  			<option value="<?php echo $i?>"><?php echo $i?></option>
  		<?php } ?>
  	</select>
  	</span>
  <?php }?>
  </section>
  <footer>
  </footer>
</body>
</html>
