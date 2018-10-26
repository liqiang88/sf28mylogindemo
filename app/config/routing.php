<?php
// app/config/routing.php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

//$routes->add('login', new Route('/login', [
//    '_controller' => 'AppBundle:Security:login',
//]));


//$routes->addCollection(
// second argument is the type, which is required to enable
// the annotation reader for this resource
//    $loader->import("@AppBundle/Resources/config/routing.php")
//);


// loads routes from the given routing file stored in some bundle
//$loader->import("@AcmeOtherBundle/Resources/config/routing.yml")
//
//loads routes from the PHP annotations of the controllers found in that directory
$routes->addCollection(
    $loader->import("@AppBundle/Controller/", "annotation")
);


return $routes;