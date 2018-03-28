<?php 

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

require_once '../vendor/autoload.php';

//We cretae a collection to store all routes
$routes = new RouteCollection();

//I have a route that match /foo and have a default _controller corresponding to MyController
//I put this route inside a collection and name it route_name
$loginRoute = new Route(
    '/login', 
    array(
    '_controller' => 'Controller\\UserController::LoginAction')
);

//I put this route inside a collection and name it route_name
$routes->add('login_route', $loginRoute);

//I define where is the base URL
$context = new RequestContext('/');

//I create a matcher to find a specific route inside the collection
$matcher = new UrlMatcher($routes, $context);

$url = $_SERVER['REQUEST_URI'];
if(substr($url, 0, strlen('/index.php')) == '/index.php'){
    $url = substr($url, $strl('/index.php'));
}

//I try to match my UR
$parameters = $matcher->match($url);

