<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Article</title>
  		<link rel="stylesheet" type="text/css" href="/css/create-article.css" />
  		<link rel="stylesheet" type="text/css" href="/css/common.css"/>
	</head>
	
	<body>
		<?php include 'header.php'?>
		<h2>Create article</h2>
		<form action="/create-article.php" method="POST">
			<label for="article-name">Name:</label>
			<input type="text" name="article-name" value="<?php echo htmlentities($articleName ?? null)?>"/>
			<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($articleName ?? null)){?>
				<p class="has-error">Name must not be empty</p>
			<?php }?>
			<label for="article-price">Description:</label>
			<input type="text" name="article-description" value="<?php echo htmlentities($articleDescription ?? null)?>"/>
			<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($articleDescription ?? null)){?>
				<p class="has-error">Description must not be empty</p>
			<?php }?>
			<label for="article-description">Image:</label>
			<input type="text" name="article-image" value="<?php echo htmlentities($articleImage ?? null)?>"/>
			<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($articleImage ?? null)){?>
				<p class="has-error">Image url must not be empty</p>
			<?php }?>
			<button type="submit">Create</button>
		</form>
	</body>
</html>