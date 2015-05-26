<?php
/**
 * global.php
 * This file contains basic setups and inclusion of most common files
 * required across the board.
 *
 * PHP versions 5
 *
 * @category include
 * @package Unimarket
 * @author David Lin <davidforest@gmail.com>
 * @copyright 2006 UniMarket.net.au
 * @version 1.0.0
 * @since File available since Release 1.0.0
 */
// prevent calling this page directly
if (realpath($_SERVER['SCRIPT_FILENAME']) == __FILE__){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /");
    exit ("DO NOT TRY TO ACCESS THIS FILE DIRECTLY\r\n");
}
// initliazie the session
session_start();
// some php configuration
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
putenv("TZ=Australia/Melbourne"); // User TimeZone

// Define Site Address Constant
define("DOMAIN_NAME", 'http://www.unimarket.com.au');
define("TRADING_NAME", 'UniSale.com.au');
define("CONTACT_EMAIL", 'web@unimarket.com.au');
define("ACCOUNT_EMAIL", 'account@unimarket.com.au');
// Define Theme
define('THEME', 'default');
define('APP', 'UNISALE');
// Define System root
define('DOC_ROOT', 'C:/Program Files/Apache Group/Apache2/htdocs');
define('APP_ROOT', DOC_ROOT . '/test');
define('TPL_ROOT', APP_ROOT . '/themes/' . THEME . '/templates');
define('CLASS_ROOT', APP_ROOT . '/classes');


define('LISTING_IMG_ROOT', APP_ROOT.'/clients/listings');


define('WEB_DIR', '/test');
define('IMG_DIR', WEB_DIR.'/themes/' . THEME.'/img');
define('CSS_DIR', WEB_DIR.'/themes/' . THEME.'/css');
define('JS_DIR', WEB_DIR.'/scripts');
define('LISTING_IMG_DIR', WEB_DIR.'/clients/listings');
define('PHPTHUMB_DIR', WEB_DIR.'/tools/phpThumb/phpThumb.php?src=');


// Database url used by Pear DB for connection to Mysql database;
define("DB_DSN", 'mysql:host=localhost;dbname=unimarket');
define("DB_USR", 'unimarket');
define("DB_PWD", '123456');

// include necessary file
function __autoload($class_name){
    require_once (CLASS_ROOT . '/' . $class_name . '.class.php');
}

?>