<?php
    date_default_timezone_set('America/Sao_Paulo');

    require 'vendor/autoload.php';

    $router = require 'src/Routers/web.php';

    $router->init();