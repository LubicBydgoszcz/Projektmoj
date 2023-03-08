<?php

require_once('./../src/config.php');

use Steampixel\Route;

Route::add('/', function() {
    echo "Strona Główna";
});

Route::run('/projektmoj/pub');
?>