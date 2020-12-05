<?php

include $_SERVER["DOCUMENT_ROOT"] . "/includes/db.php";

$article_id = $_GET["id"];
$data = $_POST;

$article = R::findOne( "articles", "id=?", array($article_id) );

if ( !($article) )
{
    exit("статьм нет");
}

if ( isset($data["do_comment"]) )
{

    if ( $data["new_comment_text"] != "" )
    {
        $new_comment = R::dispense("comments");
        $new_comment->author = $_SESSION["logged_user"]->login;
        $new_comment->text = $data["new_comment_text"];
        $new_comment->article_id = $article_id;
        R::store($new_comment);
        header("Location: ". $_SERVER['REQUEST_URI']);
    } else {
        $comment_error = "Enter text for comment";
    }

}

?>



<!DOCTYPE html>
<html>
<head>
	<title><?php echo $article["title"] ?></title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="../css/article_style.css">

    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>


<section class="article">
		

		<div class="first_part">
			<img class="article_img" src=<?php echo $article["picture_link"] ?>>
			<div class="article_about">
				<div>
					<h1 class="title"><?php echo $article["title"] ?></h1>
					<h5><?php echo $article["pub_date"]?></h5>
				</div>
			</div>
		</div>
		<p><?php echo $article["text"]; ?></p>

		<hr>

	</section>


	<section class="comments">

		<?php
			$all_comments = R::find( "comments", "article_id=?", array($article_id) );
			foreach ($all_comments as $comm) {
				echo '<div class="comment"><strong><p>' . $comm["author"] . '</p></strong><p>' . $comm["text"] . '</p></div><hr>';
			}

			if ( $comment_error )
			{
				echo "<div style='color:red';>$comment_error</div>";
			}


			if ( isset($_SESSION["logged_user"]) )
			{

		?>

		<form method="POST" action="" class="comment_form">
			<div class="send_comment_block">
				<textarea rows=3 type="text" name="new_comment_text" id="new_comment_text"></textarea>
				<button type="submit" id="send_comment" name="do_comment"><img src="https://i.imgur.com/W2DowiM.png"></button>
			</div>

		</form>

		<?php
			} else {
				echo "<div style='margin-bottom: 100px; color: grey'>Sign-In to send comments.</div>";
			}
		?>

	</section>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</body>
</html>