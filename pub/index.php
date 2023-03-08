<?php

require_once('./../src/config.php');

use Steampixel\Route;

Route::add('/', function() {
    global $twig;
    $postArray = Post::getPage();
    $twigData = array("postArray" => $postArray,
                        "pageTitle" => "Strona główna");
    $twig->display("index.html.twig", $twigData);
});

Route::add('/upload', function() {
    global $twig;
    $twigData = array("pageTitle" => "Wgraj mema");
    $twig->display("upload.html.twig", $twigData);
});

Route::add('/upload', function() {
    global $twig;
    if(isset($_POST['submit'])){
        Post::upload($_FILES['uploadedFile']['tmp_name']);
     }
     header("Location: http://localhost/projektmoj/pub");
}, 'post');

Route::run('/projektmoj/pub');
?>