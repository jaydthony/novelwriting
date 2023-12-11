<?php

ob_start(); // output buffering is turned on

error_reporting(0);
ini_set('display_errors', 0);

// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

// Assign file paths to PHP constants

// __FILE__ returns the current path to this file

// dirname() returns the path to the parent directory

define("PRIVATE_PATH", dirname(__FILE__));

define("PROJECT_PATH", dirname(PRIVATE_PATH));

define("PUBLIC_PATH", PROJECT_PATH . '/public');

define("SHARED_PATH", PRIVATE_PATH . '/shared');

define("API_PATH", PRIVATE_PATH . '/api');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/') + 0;

$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);

define("WWW_ROOT", $doc_root);

define("NAIRA", '₦');

// Load class definitions manually

// -> Individually

// require_once('classes/admin.class.php');

// -> All classes in directory

foreach (glob('classes/*.class.php') as $file) {

    require_once $file;

}

// Autoload class definitions

function my_autoload($class)
{

    if (preg_match('/\A\w+\Z/', $class)) {

        include 'classes/' . $class . '.class.php';

    }

}

spl_autoload_register('my_autoload');

date_default_timezone_set("Africa/Lagos");

$db = Database::db_connect();

databaseObject::set_database($db);

ini_set('max_execution_time', 0);

$errors = [];

$session = new Session;

$siteinfo = Site::find_by_id(1);

$company_name = Whiz::h($siteinfo->company_name);

define('COMPANY_NAME', $company_name);

$logged_user = Admin::find_by_username($_SESSION['username'] ?? "");

$username = Whiz::f($logged_user->username ?? '');

$date_only = date("Y-m-d");

$time_only = date('h:i:s a');

$complete_date = date("F j, Y, g:i a");

define("DOMAIN_PATH", "https://writing.com/");

