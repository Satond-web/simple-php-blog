<?php

include $_SERVER["DOCUMENT_ROOT"] . '/includes/db.php';
$articles = R::find("articles", "ORDER BY id DESC");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/articles_style.css">

    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>



<section class="articles">
		
		<?php

			foreach ($articles as $article)
			{


		?>
		<a href=<?php echo "/article?id=" . $article["id"]; ?>>
			<div class="article">
				<div class="first_part">
					<img class="article_img" src=<?php echo $article["picture_link"] ?>>
					<div class="article_about">
						<div>
							<h1 class="title"><?php echo $article["title"] ?></h1>
							<h5><?php echo $article["pub_date"] ?></h5>
							<h4><?php echo $article["about"]; ?></h4>
						</div>
					</div>
				</div>
			</div>
		</a>
		<hr>

		<?php } ?>

	</section>


    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>


</body>
</html>