<?php

require $_SERVER['DOCUMENT_ROOT'] . "/includes/db.php";

$data = $_POST;


if ( isset($_SESSION["logged_user"]) )
{
    echo "You are already logged in <br><a href='/'>Main Page</a>";
    die();

} else {
    if ( isset($data["do_login"]) )
    {
        $errors = array();

        if ( $data["login"] == "" ) $errors[] = "Please enter your login";
        if ( $data["password"] == "" ) $errors[] = "Please enter your password";

        if ( empty($errors) )
        {
            $user = R::findOne( "users", "login=?", array($data["login"]) );
            if ( $user )
            {
                if (password_verify($data["password"], $user->password))
                {
                    $_SESSION["logged_user"] = $user;
                    header("Location: /");

                } else {
                    $errors[] = "Please enter a valid password";
                }
            } else {
                $errors[] = "Please enter a valid username";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/login_style.css">

    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>


<section class="middle_section">
		<h1>Satond - Blog</h1>
		<h4>Welcome Back</h4>

		<form method="POST" action="" id="login_form">
			<?php
			
			if ( !empty($errors) )
			{
				echo "<p style='color:red;'>" . array_shift($errors) . "</p>"; 
			}

			?>
			<input autofocus class="input_field" type="text" name="login" placeholder="Login" value=<?php echo @$data["login"];?> >
			<br>
			<input class="input_field" type="password" name="password" placeholder="Password">
			<br>
		</form>

		<input class="subbmit_button" type="submit" name="do_login" value="Login" form="login_form">
		<!-- <button class="subbmit_button" type="submit" name="do_login" form="login_form">Login</button> -->
		<a href="/register/"> <button>Register</button> </a>
	</section>



</body>
</html>