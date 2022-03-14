<?php

define("ROOT", dirname(__DIR__));
// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

require_once ROOT . '/vendor/autoload.php'; // Autoload files using Composer autoload
$configutation = Application\Config\Configurator::config();

//bootstrap
\Application\Bootstrap::go();

//trigger init event
Mgr\Event\Event::trigger("init");


$core = new Mgr\Core\Core();

//trigger predispatch event
Mgr\Event\Event::trigger("preDispatch");

$core->dispatch();

//triger postdispatch
Mgr\Event\Event::trigger("preDispatch");
?>
