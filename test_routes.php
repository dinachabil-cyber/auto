<?php
require '/var/www/html/vendor/autoload.php';
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
$routes = new RoutingConfigurator();
$routes->import('../src/Controller/', 'attribute');
echo "Routes loaded successfully\n";