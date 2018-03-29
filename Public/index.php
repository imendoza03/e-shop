<?php 

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

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

$logoutRoute = new Route(
    '/logout',
    array(
        '_controller' => 'Controller\\UserController::LogoutAction')
    );

$registrationRoute = new Route(
    '/registration',
    array(
        '_controller' => 'Controller\\UserController::RegistrationAction'
    )
);

$homeRoute = new Route(
    '/home',
    array(
        '_controller' => 'Controller\\ArticleController::loadAction'
    )
);

$articleDetailRoute = new Route(
    '/article/detail',
    array(
        '_controller' => 'Controller\\ArticleController::detailAction'
    )
);

$articleCreationRoute = new Route(
    '/article/create',
    array(
        '_controller' => 'Controller\\ArticleController::createAction'
    )
);

$articleAddToCart = new Route(
    '/article/addToCart/{id}',
    array(
        '_controller' => 'Controller\\ArticleController::addToCartAction'
    )
);

$cartDetailRoute = new Route(
    '/cart',
    array(
        '_controller' => 'Controller\\ArticleController::loadCartAction'
    )
);
//I put this route inside a collection and name it route_name
$routes->add('login_route', $loginRoute);
$routes->add('logout_route', $logoutRoute);
$routes->add('registration_route', $registrationRoute);
$routes->add('home_route', $homeRoute);
$routes->add('article_detail_route', $articleDetailRoute);
$routes->add('article_creation_route', $articleCreationRoute);
$routes->add('article_add_cart', $articleAddToCart);
$routes->add('cart_detail_route', $cartDetailRoute);

//I define where is the base URL
$context = new RequestContext('/');

//I create a matcher to find a specific route inside the collection
$matcher = new UrlMatcher($routes, $context);

$url = $_SERVER['REQUEST_URI'];
if(substr($url, 0, strlen('/index.php')) == '/index.php'){
    $url = substr($url, strlen('/index.php'));
}

// var_dump($url);
$url = explode('?', $url)[0];
// var_dump($url);

try {
    $parameters = $matcher->match($url);
} catch (ResourceNotFoundException $e) {
    $errorCode = 404;
    $errorMessage = 'page not found';
    include '../Templates/error.php';
    die();
}

//I try to match my UR

$controller = $parameters['_controller'];
list($class, $method) = explode('::', $controller);

$controller = new $class;
$controller->$method(); 

