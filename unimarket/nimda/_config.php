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
define("CONTACT_EMAIL", 'web@unimarket.com.au');
define("ACCOUNT_EMAIL", 'account@unimarket.com.au');
// Define Theme

define('APP', 'ADMIN');
// Define System root
define('DOC_ROOT', 'C:/Program Files/Apache Group/Apache2/htdocs');
define('APP_ROOT', DOC_ROOT . '/test/nimda');
define('TPL_ROOT', APP_ROOT . '/template');
define('CLASS_ROOT', DOC_ROOT . '/test/classes');


define('WEB_DIR', '/test/nimda');
define('IMG_DIR', WEB_DIR.'/themes');
define('CSS_DIR', WEB_DIR.'/themes');
define('JS_DIR', WEB_DIR.'/scripts');


// Database url used by Pear DB for connection to Mysql database;
define("DB_DSN", 'mysql:host=localhost;dbname=unimarket');
define("DB_USR", 'unimarket');
define("DB_PWD", '123456');

// include necessary file
function __autoload($class_name){
    require_once (CLASS_ROOT . '/' . $class_name . '.class.php');
}

?>