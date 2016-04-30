<?php
use Cake\Routing\Router;

Router::plugin('Rana', function ($routes) {
    $routes->fallbacks('DashedRoute');
});
