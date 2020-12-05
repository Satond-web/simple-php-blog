<?php

require $_SERVER['DOCUMENT_ROOT'] . "/libs/rb.php";

R::setup('mysql:host=localhost;dbname=main_db', 'root', 'root');
session_start();
