<?php

declare(strict_types=1);
require __DIR__ . "/../vendor/autoload.php";

use SmartGoblin\Slaves\KernelSlave;
use SmartGoblin\Components\Core\Config;
use SmartGoblin\Components\Router\Endpoint;

$config = Config::new(__DIR__, "main", false);
$config->configureAllowedHosts(["127.0.0.1", "localhost"]);
$config->configureUnauthorizedRedirects("/login", "main");

$config->configureApi([
    Endpoint::api(false, "GET", "/health", "Health")
]);
$config->configureView([
    Endpoint::view(false, "/", "main")
]);

$slave = KernelSlave::call();
$slave->order($config);
$slave->work();

?>