<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Article</title>
  		<link rel="stylesheet" type="text/css" href="/css/create-article.css" />
  		<link rel="stylesheet" type="text/css" href="/css/common.css" />
	</head>
	
	<body>
		<h2>Create article</h2>
		<form action="/create-article.php" method="POST">
			<label for="article-name">Name:</label>
			<input type="text" name="article-name"/>
			<label for="article-price">Description:</label>
			<input type="text" name="article-description"/>
			<label for="article-description">Image:</label>
			<input type="text" name="article-image"/>
			<button type="submit">Create</button>
		</form>
	</body>
</html>