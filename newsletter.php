<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/db.php';

$email = $_GET["email"];
$new_email = R::dispense("emails");

$new_email->email = $email;
R::store($new_email);
header("Location: /?newsletter_success=1#third_section");

?>