<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.php';

?>

<!DOCTYPE html>
<html>
<head>

	<title>My Blog</title>
    <link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/index_style.css">

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

</head>



<body>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>


	<section class="first_section">
    	<table style="height: 80%; width: 100%">
            <tr>
                <td style="text-align: center">
                    <span style="vertical-align: middle;">while ( alive() ) {<pre>eat();    <br>code();   <br>//sleep();<br>}                  </pre></span>
                </td>
            </tr>
        </table>
	</section>


	<section id="last_article">
		<?php $last_article = R::findLast("articles", ""); ?>

		<div class="article">
			<p>last article</p>

			<p class="last_article_img">
				<img src=<?php echo $last_article['picture_link'];?> >
			</p>

			<h1><?php echo $last_article["title"];?> </h1>
			<h4><?php echo $last_article["pub_date"]; ?></h4>
			<p class="article_text"><?php echo $last_article["about"]; ?> </p>
		</div>

		<p class="article_button">
			<a href=<?php echo "/article?id=" . $last_article["id"];?> >
				<button class="article_button">Read More</button>
			</a>
		</p>
	</section>


	<section id="third_section">
		<p class="newsletter_p">Sing Up for our Newsletter!

		<form method="GET" action="/newsletter.php" class="newsletter_form">

            <?php if ( isset($_GET["newsletter_success"]) ) echo "<div style='color:green'>Success</div>"; ?>

			<div class="sign_up_newsletter">
				<input type="email" name="email" placeholder="Enter a valid email address" id="newsletter_email_field">
				<button type="submit" id="submit_newsletter"><img src="https://i.imgur.com/W2DowiM.png"></button>
			</div>
		</form>
	</section>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</body>
</html>