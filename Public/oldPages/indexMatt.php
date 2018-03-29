<?php
require_once '../vendor/autoload.php';

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

$routes = new RouteCollection();

$routes->add(
    'login_route', 
    new Route(
        '/login',
        array('_controller' => 'Controller\\UserController::loginAction')
    )
);
$routes->add(
    'logout_route',
    new Route(
        '/logout',
        array('_controller' => 'Controller\\UserController::logoutAction')
    )
);
$routes->add(
    'register_route',
    new Route(
        '/register',
        array('_controller' => 'Controller\\UserController::registerAction')
    )
);

$context = new RequestContext('/');

$matcher = new UrlMatcher($routes, $context);

$url = $_SERVER['REQUEST_URI'];
if (substr($url, 0, strlen('/index.php')) == '/index.php') {
    $url = substr($url, strlen('/index.php'));
}

$parameters = $matcher->match($url);

$controller = $parameters['_controller'];
list($class, $method) = explode('::', $controller);

$controller = new $class();
$controller->$method();









