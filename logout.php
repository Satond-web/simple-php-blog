<?php

include $_SERVER["DOCUMENT_ROOT"] . "/includes/db.php";

unset($_SESSION["logged_user"]);
header("Location: " . $_SERVER["HTTP_REFERER"]);
