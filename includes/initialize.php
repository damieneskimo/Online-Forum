<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', DS.'Users'.DS.'Will'.DS.'Documents'.DS.'Sites'.DS.'photo_gallery');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// load database config 
require_once('config.php');
require_once('db.php');

// load basic functions next so that everything after can use them
require_once('functions.php');

// load core objects
require_once('session.php');
require_once('database.php');

// load database-related classes
require_once('brand.php');
require_once('user.php');
require_once('topic.php');
require_once('reply.php');
