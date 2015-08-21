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
    'Venue/Hotel' => '/venue/',
    'Sponsors' => '/sponsors/',
    'What to Expect' => '/expect/',
    'Tickets' => '/tickets/',
    'Call for Papers' => 'http://cfp.madisonphpconference.com',
    'Code of Conduct' => '/conduct/',
    'Contact' => 'http://contact.madisonphpconference.com'
);

$app['nav'] = $published_menu;

$sponsors = array(
    'bronze' => array(
        array(
            'name' => 'Earthling Interactive',
            'href' => 'http://earthlinginteractive.com/',
            'img'  => '/assets/images/sponsors/earthling.png',
        ),
        array(
            'name' => 'Madison College',
            'href' => 'http://it.madisoncollege.edu/',
            'img'  => '/assets/images/sponsors/madisoncollege.png',
        ),
    ),
    'community' => array(
        array(
            'name' => 'TeamSoft, Inc.',
            'href' => 'http://www.teamsoftinc.com/',
            'img'  => '/assets/images/sponsors/teamsoft.png',
        ),
        array(
            'name' => 'Stand Stand',
            'href' => 'http://www.standstand.com/',
            'img'  => '/assets/images/sponsors/standstand.jpg',
        ),
    ),
);

$app['sponsors'] = $sponsors;

$talks = array(
    'keynote' => array(
        'speaker' => array (
            array (
                'name' => 'Paul Jones',
                'img' => '/assets/images/speakers/PaulJones.jpg',
                'bio' => '<p>Paul M. Jones is an internationally recognized <a href="http://php.net">PHP</a> expert, working in that language since 1999, and programming in general since 1983. He has held roles from junior developer to VP of Engineering in all kinds of organizations (corporate, military, non-profit, educational, medical, and others). He is a regular speaker at technical conferences worldwide.</p>

<p>As the author of <a href="https://leanpub.com/mlaphp">Modernizing Legacy Applications in PHP</a> and <a href="https://leanpub.com/sn1php">Solving the N+1 Problem in PHP</a>, Paul takes a special interest in high-quality, high-maintainability coding practices. His leadership on the <a href="http://auraphp.com">Aura for PHP</a> project reflects this interest, along with his white paper on the <a href="http://pmjones.io/adr">Action-Domain-Responder</a> pattern.</p>

<p>Among his other open-source work, Paul was the architect of the <a href="http://solarphp.com">Solar Framework</a> and the creator of the <a href="http://phpsavant.com">Savant template system</a>. He has authored a series of <a href="https://github.com/pmjones/php-framework-benchmarks">authoritative benchmarks</a> on <a href="http://paul-m-jones.com/?p=421">dynamic framework performance</a>. He was a founding contributor to the <a href="http://framework.zend.com">Zend Framework</a> (the DB, DB_Table, and View components).</p>

<p>Paul is a voting member of the <a href="http://php-fig.org">PHP Framework Interoperability Group</a>, and was the driving force behind the <a href="http://www.php-fig.org/psr/psr-1/">PSR-1 Coding Standard</a>, <a href="http://www.php-fig.org/psr/psr-2/">PSR-2 Style Guide</a>, and <a href="http://www.php-fig.org/psr/psr-4/">PSR-4 Autoloader</a> recommendations. He was one of the first elected members of the <a href="http://pear.php.net">PEAR Project</a>. He was also a member of the Zend PHP 5.3 Certification <a href="https://www.zend.com/services/certification/php-5-certification/education-advisory-board">education advisory board</a>, and wrote some of the questions on that test.</p>

<p>In a previous career, Paul was an operations intelligence specialist for the US Air Force, and enjoys putting .308 holes in targets at 400 yards.</p>',
            ),
        ),
        'title' => 'Same Thing Happens Every Time: Management, Movies, and Mythology',
        'tagline' => '',
        'talk_description' => 'Patterns are not just for programs; we also see them in people and processes. In this presentation, we will explore patterns found in popular hero(ine) stories like Star Wars, Princess Bride, Tron, The Matrix, Star Trek, The Hunger Games, The Last Airbender, Harry Potter. We will then use those lessons to work through some patterns in the workplace, including the people you meet and the organizations they belong to, with an emphasis on how to work effectively with them.',
    ),
    'A1' => array(
        'speaker' => array (
            array (
                'name' => 'Chris Tankersley',
                'img' => '/assets/images/speakers/ChrisTankersley.jpg',
                'bio' => 'Chris Tankersley is a husband, father, and PHP developer in Northwest Ohio. He works for The Brick Factory in Washington, D.C. doing Drupal, Wordpress, and custom development, founded the Northwest Ohio PHP User Group, and works with local developers helping them with programming and server administration. He works in a variety of languages, including PHP, nodejs, Python, and others.',
            ),
        ),
        'title' => 'OOP is More than Cars and Dogs',
        'tagline' => '',
        'talk_description' => 'When developers are introduced to Object Oriented Programming, one of the first things that happens is that they are taught that nouns turn into objects, verbs into methods, and Dog is a subclass of Animal. OOP is more than just turning things into classes and objects and showing that both Boats and Cars have motors, and that Dogs and Cats both speak(). Let\'s look at OOP in real world settings and go beyond cars and dogs, and see how to use Object Oriented Programming properly in PHP. Traits, Composition, Inheritance, none of it is off limits! (No animals were harmed in preparation for this talk, though there was mention of showing how a dog can have wheels. And yes, the title is supposed to be Cars and Dogs.)',
    ),
    'A2' => array(
        'speaker' => array (
            array (
                'name' => 'Lyndsey Padget',
                'img' => '/assets/images/speakers/LyndseyPadget.jpg',
                'bio' => 'Lyndsey Padget is a technical architect at VML in Kansas City. With over a decade of experience at both mega-corporations and startups, she specializes in designing maintainable and intuitive RESTful APIs. Java runs through her veins (the language and the beverage) and she is an undisputed Eclipse ninja. Her latest obsessions are Google APIs and Angular.js. Trained in agile methodologies, she occasionally stunt-doubles as a project manager (and also, because she is bossy). Lyndsey is involved in local organizations that encourage young women to explore careers in math and science. She believes that the difference between a decent software engineer and a great one often has little to do with code.',
            ),
        ),
        'title' => 'REST for an Hour',
        'tagline' => '',
        'talk_description' => 'REST is everywhere. You may have consumed RESTful APIs before, but implementing your own can present unique design challenges. In this session, we\'ll start off with an overview of REST and why/how it\'s used. We\'ll quickly get into the basic principles of RESTful APIs, terminology, design patterns, data, pitfalls, best practices, and more.',
    ),
    'A3' => array(
        'speaker' => array (
            array (
                'name' => 'Hao Luo',
                'img' => '/assets/images/speakers/HaoLuo.jpg',
                'bio' => 'Hao Luo is a Senior Developer at Northwestern University. He is active in the PHP community and an organizer of Laravel Chicago. He is an advocate for web accessibility, vanilla JavaScript, and unit testing. In his spare time, he is an amateur photographer and is currently learning improv.',
            ),
        ),
        'title' => 'Ditching JQuery',
        'tagline' => '',
        'talk_description' => 'JQuery is awesome, but with all major browsers following the ES and HTML5 specs, the library has become more of a convenience than a necessity for browser compatibility. While the library is useful and ubiquitous, it does distract us from learning the language that it\'s built on. This talk will outline functionality that pure JavaScript provides, and also provide steps we can take to begin writing vanilla JavaScript applications and start appreciating the power and uniqueness of JavaScript.',
    ),
    'A4' => array(
        'speaker' => array (
            array (
                'name' => 'Christopher Shepherd',
                'img' => '/assets/images/speakers/ChristopherShepherd.jpg',
                'bio' => 'Chris Shepherd has been working with PHP for over 15 years. With a wide variety of industrial experience has lead to an intimate knowledge of software development, server technologies, hardware, networking, and web solutions.',
            ),
        ),
        'title' => 'Finding Your Place',
        'tagline' => '',
        'talk_description' => 'Have you found yourself wondering if you should be looking for a new job? Does your job haunt your off time, or you feel like you are complaining too much lately? In this talk we will focus on how to find the passion for your work again, give you some tips and tricks for discovering where your skill set and interests lay, and help you figure out if it is time to start looking. Too often we are quick to jump into a new job to fix the problems, only to find our next job is the same. Lets look at if you can’t change your current position to meet your needs better, or if it is time to change, how to figure out what it is you are looking for.',
    ),
    'B1' => array(
        'speaker' => array (
            array (
                'name' => 'Alex Fraundorf',
                'img' => '/assets/images/speakers/AlexFraundorf.jpg',
                'bio' => 'Alex is a freelance web developer from Appleton, Wisconsin with over ten years of experience. His specialty is in object orientated PHP development and communication with third party APIs.
Alex is a published author on SitePoint.com, creator of a popular shipping library, an advocate of loose coupling, and has a passion for making complicated topics understandable, an ability honed by making plenty of mistakes and learning things the hard way.
Alex can be contacted via AlexFraundorf.com and @AlexFraundorf',
            ),
        ),
        'title' => 'Intro to Interfaces - PHP Plugins',
        'tagline' => '',
        'talk_description' => 'The how and why of using PHP interfaces can be very confusing and often seem like it is just not worth the trouble. After attending this talk you will have a foundation into what PHP interfaces are, why they are worth using, when you should use them, and most importantly how to use them to write cleaner, easier to maintain and easier to reuse modules of code. Essentially interfaces are going to make your development process better and more productive. Through the course of the talk we will walk through a real world example of sending an email from an application. We will start with a tightly coupled (hard to maintain and test) legacy email script, add the use of an interface and then move on step-by-step to a modern, loosely coupled and easily swappable PHP plugin. Time permitting there will also be discussion of using abstract classes in PHP, how they are similar and different to interfaces, and how to choose which to use for your situation.',
    ),
    'B2' => array(
        'speaker' => array (
            array (
                'name' => 'Austin Morris',
                'img' => '/assets/images/speakers/AustinMorris.png',
                'bio' => 'I\'ve been a full stack developer for several years, specializing in robust, maintainable PHP back-end software.  I am currently a Senior Engineer at Varsity News Network where I\'ve leveraged PHP best practices for the benefit of high school athletic departments.  As the co-author of Peridot, I enjoy writing declarative, efficient, and (most importantly) useful tests.  I am the co-organizer, and a frequent presenter at <a href="http://www.meetup.com/GrPhpDev/">GrPhpDev</a>, the PHP Meetup Group in Grand Rapids, Michigan (a.k.a Beer City, USA).',
            ),
        ),
        'title' => 'Micro-frameworks Make Awesome APIs',
        'tagline' => '',
        'talk_description' => 'Modern micro-frameworks are the ideal platform for building robust, powerful, and maintainable APIs. To a client, an API has two simple tasks: receive a request and return a response. To a developer, a good API must juggle layers of authentication, authorization, content negotiation, resource hydration, validation, and serialization. Micro-frameworks excel at handling requests, folding in layers of middleware logic, and forming a response. In this session, we\'ll compare and contrast Silex and Lumen, side-by-side, as we build working, capable, and dare-we-say RESTful APIs.',
    ),
    'B3' => array(
        'speaker' => array (
            array (
                'name' => 'Mike Willbanks',
                'img' => '/assets/images/speakers/',
                'bio' => 'Mike Willbanks lives in Minneapolis, MN where he is the Vice President of Development at Packet Power. Mike has been writing PHP (amongst other languages) professionally since the late 90\'s. He is passionate about open source software, [enterprise] architecture, and ensuring a comprehensive full-stack system. He was the founder of MNPHP and is now a co-organizer of the group. He is also involved in the Midwest PHP conference, serves on the community review team for Zend Framework and is part of the Zend Framework Education Advisory Board.',
            ),
        ),
        'title' => 'Taming the MySQL Vagabond',
        'tagline' => '',
        'talk_description' => 'MySQL is one of the most popular open source databases and chances are you have utilized it in several projects. However, what happens when things start to go seriously wrong? How do you avoid those nasty crashes that wake you up at 3am in the morning? This talk will go through several characteristics of tuning MySQL to squeeze out extra performance and stability, next we will look at how to debug problems and lastly avoiding things that will make MySQL run away like a vagabond.',
    ),
    'B4' => array(
        'speaker' => array (
            array (
                'name' => 'Patrick Schwisow',
                'img' => '/assets/images/speakers/PatrickSchwisow.jpg',
                'bio' => 'Patrick has been into web technologies since the "bad old days" when animated GIFs were required on all sites and the BLINK tag still had some supporters. He suffered through several years of procedural programming in PHP4 before discovering the glories of OOP in PHP5. Patrick is a Software Engineer at Shutterstock, with experience in Doctrine, Symfony, and several less fun technologies. After hours, he\'s the founder and organizer of the Lake / Kenosha County PHP Users Group and a contributor to the Phergie IRC Bot.',
            ),
        ),
        'title' => 'Conquering Uncomfortable Code Reviews',
        'tagline' => '',
        'talk_description' => 'Whether you are doing individual client work or are part of a large team, even the best of us can overlook things, but a mistake that makes it to production means no sleep, unhappy customers, and lost revenue. Peer code reviews minimize this risk and give you confidence in the code you write, allowing you to make big improvements in code quality without bringing your work to a crawl. Learn how to overcome your fears of sharing your code by incorporating peer reviews into your workflow.',
    ),
    'C1' => array(
        'speaker' => array (
            array (
                'name' => 'Aaron Piotrowski',
                'img' => '/assets/images/speakers/',
                'bio' => 'Computer programmer, web application designer, photographer, and coffee lover.<br>
Creator of <a href="https://github.com/icicleio/icicle">Icicle</a>, a PHP framework for writing asynchronous code using synchronous coding techniques.',
            ),
        ),
        'title' => 'Migrating to PHP 7',
        'tagline' => '',
        'talk_description' => 'This talk examines how existing PHP 5.x code can be migrated to PHP 7. We will discuss each of PHP 7\'s new features and backwards compatibility breaks and look at how they might impact or be used to improve existing code. We will also briefly look at how you can set up a PHP 7 testing environment so you can be sure your code is ready before upgrading your production server.',
    ),
    'C2' => array(
        'speaker' => array (
            array (
                'name' => 'Andrea Soper',
                'img' => '/assets/images/speakers/madison-php-logo.jpg',
                'bio' => '',
            ),
            array (
                'name' => 'Joseph Purcell',
                'img' => '/assets/images/speakers/JosephPurcell.png',
                'bio' => 'Joseph D. Purcell has been part of the PHP community since 2003. He has a highly diverse technical background with extensive experience in front- and back-end development, system administration, and database administration. He has been responsible for finding and resolving performance bottlenecks in complex highly available systems, using and promoting PHP and web standards and best practices, upgrading and extending legacy PHP platforms, and integration and release management. As a technologist, he is inspired by emerging technologies and the discoveries being made from cross-disciplinary research. He is exercising these many talents at Palantir in Chicago.',
            ),
        ),
        'title' => 'Technical Debt Insights from the Lorax',
        'tagline' => '',
        'talk_description' => 'Technical debt is a common analogy to describe the cost of code mess and poor architecture. However, how far can the monetary analogy go? In this session we will look at insights from the Lorax and “environmental debt”. Specifically, we will build an argument for why the monetary comparison communicates the wrong idea about how technical debt is measured and how it impacts business. We will conclude with identifying measures and practices to mitigate technical debt. This session might be for you if you deal with the challenge of communicating the business cost of technical debt, you want a clearer understanding of what technical debt is and how to measure it, or you want advice on how to mitigate against technical debt. The key takeaway from this session will be an improved strategy for identifying, measuring, preventing, and communicating technical debt.',
    ),
    'C3' => array(
        'speaker' => array (
            array (
                'name' => 'Joe Ferguson',
                'img' => '/assets/images/speakers/JoeFerguson.jpg',
                'bio' => 'PHP Dev, Sys Admin, Community Builder, Conf Organizer & Speaker, Maker, Hacker, Tinkerer, Space Geek, Husband. Enjoys craft beers and whiskey. Owned by cats.',
            ),
        ),
        'title' => 'DevOps For Small Teams',
        'tagline' => '',
        'talk_description' => 'DevOps is a large part of a company of any size. In the 9+ years that I have been a professional developer I have always taken an interest in DevOps and have been the "server person" for most of the teams I have been a part of. I would like to teach others how easy it is to implement modern tools to make their everyday development and development processes better. I will cover a range of topics from "Stop using WAMP/MAMP and start using Vagrant", "version control isn\'t renaming files", "Automate common tasks with shell scripts / command line PHP apps" and "From Vagrant to Production".',
    ),
    'C4' => array(
        'speaker' => array (
            array (
                'name' => 'Aaron Jorbin',
                'img' => '/assets/images/speakers/AaronJorbin.jpg',
                'bio' => 'Aaron Jorbin is a polyhistoric man of the web. Currently Technical Architect on the Conde Nast Platform Team and a WordPress Core Committer, he works to improve developer happiness and is dedicated to making the internet usable and enjoyable by everyone. He tweets at <a href="http://twitter.com/aaronjorbin">@aaronjorbin</a> and writes regularly at <a href="http://aaron.jorb.in">aaron.jorb.in</a>.',
            ),
        ),
        'title' => 'How Not To Build a WordPress Plugin',
        'tagline' => '',
        'talk_description' => 'WordPress has powerful plugin architecture that enables you to build almost anything on top of WordPress. This power though can lead to anti-patterns that slow down sites, confuse users, and make it hard to scale. Let’s look at the wrong way of building plugins so you can avoid these traps.',
    ),
    'D1' => array(
        'speaker' => array (
            array (
                'name' => 'Jessica Mauerhan',
                'img' => '/assets/images/speakers/JessicaMauerhan.jpg',
                'bio' => '',
            ),
        ),
        'title' => 'Rebuilding our Foundation: How We Used Symfony To Rewrite Our Application in Six Months',
        'tagline' => '',
        'talk_description' => 'This talk is about how my company took a broken e-commerce and LMS site written in an older style MVC framework and re-wrote a significant portion of it in Symfony and related tools (Doctrine, FOS Bundles, Sonata) over 6 months and created a stable, well-tested application. I’ll cover the approach we took to rewriting the admin panel in Symfony, writing an API, introducing Behat and PHPUnit tests for both new and legacy code (still in a separate framework) and setting up Continuous Integration. I’ll discuss how we optimized the site as we went, by identifying weak spots in the code and how we addressed them. I’ll also cover what we would do differently now that we’ve done it once.',
    ),
    'D2' => array(
        'speaker' => array (
            array (
                'name' => 'Maxwell Vandervelde',
                'img' => '/assets/images/speakers/MaxwellVandervelde.png',
                'bio' => 'Maxwell is a Software Engineer at <a href="http://SmartThings.com">SmartThings</a> in Minneapolis, MN. He has worked on architecting backend API\'s built in PHP in addition to the Android applications that interact with them. He is a passionate open-source software developer specializing in both PHP and Android applications.',
            ),
        ),
        'title' => 'Demilitarizing HTTP -- Developing API\'s for Mobile applications',
        'tagline' => '',
        'talk_description' => 'HTTP is simple and ubiquitous, but it isn\'t always easy. In his talk for Android developers, Jesse Wilson describes HTTP as a "hostile world" saying "The network is unreliable. 3G networking is slow. Using WiFi drains your battery. The NSA is spying on you." Keep your mobile-developer friends your friends. Mobile development suffers a lot of unique problems. A poorly designed back-end API shouldn\'t be one of them. How can you make their lives easier? Plan ahead. Come to this talk to get to know the problems that mobile projects have. In this session we\'ll talk about all the different ways that you can make your API more friendly to mobile application development including caching, security, and resource management.',
    ),
    'D3' => array(
        'speaker' => array (
            array (
                'name' => 'Rocco Palladino',
                'img' => '/assets/images/speakers/RoccoPalladino.jpg',
                'bio' => 'Rocco Palladino is a web applications developer at the University of Chicago, working mainly with PHP since 2006.',
            ),
        ),
        'title' => 'Containerizing PHP applications with Docker',
        'tagline' => '',
        'talk_description' => 'Docker is a lightweight virtualization and containerization technology that is rapidly changing the way applications are developed, packaged, and deployed. This talk will present a beginner\'s introduction to Docker for PHP developers. We\'ll start with a high-level overview of containers and how Docker helps to manage them. Then we\'ll learn how to containerize a PHP application for local development and how to deploy it to production. We\'ll see how Docker containers can be a useful alternative to Vagrant VMs as a solution to the problem of development and production parity (a.k.a. the "it works on my machine" problem).',
    ),
    'D4' => array(
        'speaker' => array (
            array (
                'name' => 'Eryn O’Neil',
                'img' => '/assets/images/speakers/',
                'bio' => '',
            ),
        ),
        'title' => 'TBA',
        'tagline' => '',
        'talk_description' => '',
    ),
    'E1' => array(
        'speaker' => array (
            array (
                'name' => 'Daniel Greig',
                'img' => '/assets/images/speakers/DanielGreig.jpg',
                'bio' => 'Daniel Greig is a technical lead at Earthling Interactive. He has worked in a variety of languages and systems over the last 15 years.',
            ),
        ),
        'title' => 'Bugs bugs everywhere!',
        'tagline' => '',
        'talk_description' => 'Bugs are introduced to programs all the the time. When that happens we get to look at the code and figure out why there is a bug and squash it. In this talk I will be going over the basic techniques and tools that I use to track them down and figure out what is going on.',
    ),
    'E2' => array(
        'speaker' => array (
            array (
                'name' => 'Matt Frost',
                'img' => '/assets/images/speakers/MattFrost.jpg',
                'bio' => 'Matt has been working with PHP for the better part of 10 years and is currently working as the Director of Engineering for Budget Dumpster. Matt has an interest in testing, automating workflow and deployments, OAuth implementations and clean, reusable code. Matt has an OAuth book coming out (if it\'s not out already), blogs at http://shortwhitebaldguy.com, co-hosts the Loosely Coupled podcast and enjoys making jokes on Twitter from time to time. When he\'s not doing programming related activities, Matt enjoys running, reading, It\'s Always Sunny in Philadelphia, acting like a kid with his wonderful children, burritos, jumping out of perfectly good airplanes and stouts/porters.',
            ),
        ),
        'title' => 'Ain\'t Nobody Got Time For That!: An Intro to Automation',
        'tagline' => '',
        'talk_description' => 'The process of developing an application is involved, when you take into account setting up servers, managing dependencies and setting up local development environments; it can be quite overwhelming. Making sure data stores are properly seeded, dependencies are installed and that code is tested before hitting production doesn\'t have to be a labor intensive process. In this talk, we\'re going to discuss how to use automation to improve your deployment process, your development workflow and eliminate repetitive menial tasks (or least minimize them). I\'m going to cover how to automate processes with tools including, but not limited to, Phing, Ansible, Alfred and Git-Hooks. If you spend time trying to keep environments in sync, this is a talk you won\'t want to miss!',
    ),
    'E3' => array(
        'speaker' => array (
            array (
                'name' => 'Joel Clermont',
                'img' => '/assets/images/speakers/JoelClermont.jpg',
                'bio' => 'PHP and C# developer living in the Milwaukee area. Organizer of Milwaukee PHP and Milwaukee Functional Programming user groups. Addicted to learning, teaching and growing the developer community. Currently obsessed with functional programming.',
            ),
        ),
        'title' => 'Hack - Why Should I Care?',
        'tagline' => '',
        'talk_description' => 'In March 2014, Facebook released a new language called Hack. It adds static typing, generics and lambda expressions on top of the rest of the familiar PHP syntax. In addition, it allows for gradual adoption of these features and continued interoperability with existing PHP code. But why should you care? Do you need to work in a massive environment like Facebook to reap the rewards of learning a new language? I’ll make a strong case that Hack (and HHVM) are worth your time, give you a good demo of the language and show you how to get started. I don’t work for Facebook, but I dove into Hack the day it was announced and I’ve continued to follow its development with great interest. I have applications in production running on Hack and I’m eager to show PHP developers of all skill levels why it’s worth their time to give Hack a look.',
    ),
    'E4' => array(
        'speaker' => array (
            array (
                'name' => 'Samantha Quiñones',
                'img' => '/assets/images/speakers/SamanthaQuinones.jpg',
                'bio' => 'Samantha Quiñones is a Principal Software Engineer at AOL, where she designs and builds systems that help creators tell stories.',
            ),
        ),
        'title' => 'Hacking the Human Interface',
        'tagline' => '',
        'talk_description' => '',
    ),
);

$app['talks'] = $talks;

// use layout templates
$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', null);
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig.html'));
});

// route for home page
$app->get('/', function() use($app) {
    return $app['twig']->render('pages/home.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Home',
    ));
});

// route for schedule
$app->get('/schedule/', function() use($app) {
    return $app['twig']->render('pages/schedule.html', array(
        'nav' => $app['nav'],
        'talks' => $app['talks'],
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
        'sponsors' => $app['sponsors'],
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

// routes for schedule
$app->get('/talks/A1/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['A1'],

    ));
});
$app->get('/talks/A2/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['A2'],

    ));
});
$app->get('/talks/A3/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['A3'],

    ));
});
$app->get('/talks/A4/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['A4'],

    ));
});
$app->get('/talks/B1/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['B1'],

    ));
});
$app->get('/talks/B2/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['B2'],

    ));
});
$app->get('/talks/B3/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['B3'],

    ));
});
$app->get('/talks/B4/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['B4'],

    ));
});
$app->get('/talks/C1/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['C1'],

    ));
});
$app->get('/talks/C2/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['C2'],

    ));
});
$app->get('/talks/C3/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['C3'],

    ));
});
$app->get('/talks/C4/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['C4'],

    ));
});
$app->get('/talks/D1/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['D1'],

    ));
});
$app->get('/talks/D2/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['D2'],

    ));
});
$app->get('/talks/D3/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['D3'],

    ));
});
$app->get('/talks/D4/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['D4'],

    ));
});
$app->get('/talks/E1/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['E1'],

    ));
});
$app->get('/talks/E2/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['E2'],

    ));
});
$app->get('/talks/E3/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['E3'],

    ));
});
$app->get('/talks/E4/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'talk' => $app['talks']['E4'],

    ));
});



$app->run();
