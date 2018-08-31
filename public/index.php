<?php
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

/**
 * BASE_PATH je naš root folder
 * APP_PATH je putanja ka app folderu
 */

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * FactoryDefault Dependency Injector automatski registruje sve
     * servise potrebne za full stack frejmvork.
     */
    $di = new FactoryDefault();

    /**
     * U router-u pišemo sve rute u aplikaciji
     */
    include APP_PATH . '/config/router.php';

    /**
     * Učitavanje servisa
     */
    include APP_PATH . '/config/services.php';

    /**
     * Učitavanje konfiguracije
     */
    $config = $di->getConfig();

    /**
     * Ubacivanje autoloader-a
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Opsluživanje zahteva ka aplikaciji
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
