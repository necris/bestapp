<?php
define("BASE_DIR", __DIR__);
define("TEMP_DIR", BASE_DIR . "/temp");
define("APP_DIR", BASE_DIR . "/app");
define("CFG_DIR", BASE_DIR . "/config");
define("DATA_DIR", BASE_DIR . "/data");

require_once "vendor/autoload.php";

// create and register RobotLoader
$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(APP_DIR);
$loader->setTempDirectory(TEMP_DIR);
$loader->register();

// Run DI
$loader = new Nette\DI\ContainerLoader(TEMP_DIR, true);
$class = $loader->load(function ($compiler) {
    $compiler->loadConfig(CFG_DIR . '/config.neon');

});
$container = new $class;
// create and run Symfony console app
$application = $container->getByType(\Symfony\Component\Console\Application::class);
$application->run();