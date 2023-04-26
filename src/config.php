<?php
require_once('./../vendor/autoload.php');
$db = new mysqli("localhost", "root", "", "bazacms");
require("Post.class.php");
require("user.class.php");
require("vote.class.php");

$loader = new Twig\Loader\FilesystemLoader("./../src/templates");

$twig = new Twig\Environment($loader);
?>