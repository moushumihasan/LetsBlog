<?php
session_start();
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "password");
define("DB_NAME", "lets_blog");


$link = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die("Could not connect to database server");
mysql_select_db(DB_NAME, $link);

define("LINK", $link);

define("HOME_PAGE", 'http://' . $_SERVER["SERVER_NAME"] .  '/home.php');

define("LOGIN_PAGE", 'http://' . $_SERVER["SERVER_NAME"]);


require("functions.php");