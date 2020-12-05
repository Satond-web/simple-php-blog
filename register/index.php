<?php 

include $_SERVER["DOCUMENT_ROOT"] . "/includes/db.php";

$data = $_POST;
$errors = array();

if ( isset($_SESSION["logged_user"]) )
{
    echo "You are already logged in <br><a href='/'>Main Page</a>";
    die();

} else {

    if ( isset($data["do_register"]) )
    {
        if ( $data["login"] == "" ) $errors[] = "Please enter your new login";
        if ( $data["password"] == "" ) $errors[] = "Please enter your password";
        if ( $data["password_2"] == "" ) $errors[] = "Please enter your password";
        if ( $data["password"] != $data["password_2"] ) $errors[] = "Please enter a correct password";


        if ( empty($errors) )
        {
            if ( R::count("users", "login=?", array($data["login"])) <= 0)
            {
                $user = R::dispense("users");
                $user->login = $data["login"];
                $user->password = password_hash($data["password"], PASSWORD_DEFAULT);
                R::store($user);
                $_SESSION["logged_user"] = $user;
                header("Location: /");

            } else {
                $errors[] = "This login already taken!";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
    <link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/register_style.css">

    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>


    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <section class="middle_section">
		<h1>Satond - Blog</h1>
		<h4>Register</h4>

		<form method="POST" action="" id="register_form">
			<?php
			
			if ( !empty($errors) )
			{
				echo "<p style='color:red;'>" . array_shift($errors) . "</p>"; 
			}

			?>
			<p>Login</p>
			<input autofocus class="input_field" type="text" name="login" value=<?php echo @$data["login"];?> >
			<p>Password</p>
			<input class="input_field" type="password" name="password">
			<p>Repeat Password</p>
			<input class="input_field" type="password" name="password_2">

		</form>

		<input class="subbmit_button" type="submit" name="do_register" value="Register" form="register_form">
		<!-- <a href="/register/"> <button>Register</button> </a> -->

		<p class="login_link">Alredy on our Blog? <a href="/login/">Sign in</a></p>
	</section>


</body>
</html>