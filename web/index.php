<?php

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// turn off debug mode for live site
$app['debug'] = (gethostname() == 'web01') ? false : true;

// register twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

$published_menu = array(
    'Home' => '/',
    //'Schedule' => '/schedule/',
    //'Speakers' => '/speakers/',
    'Venue' => '/venue/',
    'Hotel' => '/hotel/',
    'Sponsors' => '/sponsors/',
    'What to Expect' => '/expect/',
    'Organizers' => '/organizers/',
    'Tickets' => '/tickets/',
    'Call for Papers' => 'http://cfp.madisonphpconference.com',
    'Code of Conduct' => '/conduct/',
    'Contact' => 'http://contact.madisonphpconference.com'
);

$app['nav'] = $published_menu;

// use layout templates
$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', null);
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig.html'));
});

// route for home page
$app->get('/', function() use($app) {
    return $app['twig']->render('pages/home.html', array(
        'nav' => $app['nav'],
        'active' => 'Home',
    ));
});

// route for schedule
$app->get('/schedule/', function() use($app) {
    return $app['twig']->render('pages/schedule.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
    ));
});

// route for speakers
$app->get('/speakers/', function() use($app) {
    return $app['twig']->render('pages/speakers.html', array(
        'nav' => $app['nav'],
        'active' => 'Speakers',
    ));
});

// route for venue
$app->get('/venue/', function() use($app) {
    return $app['twig']->render('pages/venue.html', array(
        'nav' => $app['nav'],
        'active' => 'Venue',
    ));
});

// route for hotel
$app->get('/hotel/', function() use($app) {
    return $app['twig']->render('pages/hotel.html', array(
        'nav' => $app['nav'],
        'active' => 'Hotel',
    ));
});

// route for sponsors
$app->get('/sponsors/', function() use($app) {
    return $app['twig']->render('pages/sponsors.html', array(
        'nav' => $app['nav'],
        'active' => 'Sponsors',
    ));
});

// route for expect
$app->get('/expect/', function() use($app) {
    return $app['twig']->render('pages/expect.html', array(
        'nav' => $app['nav'],
        'active' => 'What to Expect',
    ));
});

// route for organizers
$app->get('/organizers/', function() use($app) {
    return $app['twig']->render('pages/organizers.html', array(
        'nav' => $app['nav'],
        'active' => 'Organizers',
    ));
});

// route for tickets
$app->get('/tickets/', function() use($app) {
    return $app['twig']->render('pages/tickets.html', array(
        'nav' => $app['nav'],
        'active' => 'Tickets',
    ));
});

// route for conduct
$app->get('/conduct/', function() use($app) {
    return $app['twig']->render('pages/conduct.html', array(
        'nav' => $app['nav'],
        'active' => 'Code of Conduct',
    ));
});
$app->run();
