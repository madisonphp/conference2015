<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// turn off debug mode for live site
$app['debug'] = (gethostname() == 'web01') ? false : true;

// register twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

// draft site
$draft_menu = array(
    'Home' => '/',
    'Schedule' => '/schedule/',
    'Speakers' => '/speakers/',
    'Venue' => '/venue/',
    'Hotel' => '/hotel/',
    'Sponsors' => '/sponsors/',
    'Contact' => 'http://contact.madisonphpconference.com'
);

// live site
$published_menu = array(
    'Home' => '/',
);

// set nav
if (isset($_GET['preview'])) {
    foreach ($draft_menu as $key => $val) {
        if ($key == 'Contact') continue;
        $draft_menu[$key] = $val . '?preview';
    }
    $app['nav'] = $draft_menu;
} else {
    $app['nav'] = $published_menu;
}

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

$app->run();
