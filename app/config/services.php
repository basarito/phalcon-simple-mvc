<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

/**
 * Definisanje config-a kao zajedničkog servisa
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * URL komponenta služi za generisanje različitih URL-ova u aplikaciji
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Postavljanje view komponente i registrovanje template engine-a
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Konekcija na bazu se vrši na osnovu parametara unetih u config.php fajlu
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

/**
 * Korisni servisi za korišćenje flash servisa sa Twitter Bootstrap klasama
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

$di->set(
    'flashSession',
    function () {
        return new Phalcon\Flash\Session(array(
            'error' => 'alert alert-dismissable alert-danger',
            'success' => 'alert alert-dismissable alert-success',
            'notice' => 'alert alert-dismissable alert-info',
            'warning' => 'alert alert-warning'
        ));
    }
);

/**
 * Započinjanje sesije kada prva komponenta zatraži ovaj servis
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});





