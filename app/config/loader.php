<?php

$loader = new \Phalcon\Loader();

/**
 * Registrovanje direktorijuma preuzetih iz config.php fajla
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();

/**
 * Registrovanje namespace-ova
 */

$loader->registerNamespaces(
    [
        'Controllers' => $config->application->controllersDir,
        'Models'      => $config->application->modelsDir
    ]
)->register();


