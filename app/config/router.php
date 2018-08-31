<?php

$router = $di->getRouter();

// Ovde definisati rute

$router->add('/member/view-all',
    [
        'controller' => 'member',
        'action' => 'viewAll'
    ]);

$router->handle();
