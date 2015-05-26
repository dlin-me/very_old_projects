<?php
/**
 * This is main.php, which acts as a controler handling most of requests from client;
 * It needs to maintain sessions to track that users request are valid.
 * It also presents input forms to user, which will be submitted to processor.php for further processing.
 * Parameters are pass by $_GET variable, as passing variable via get (url) limites user inputs, there is no
 * need to add/strip slashes for database query. However, invalid url will be detected and user will be 
 * redirected to the home page instead
 *
 * @author  David W. Lin 
 * @version 1.0
 * @date 28 April 2005
 */

include_once "inc/Session.php";
require_once ('/home/w3cat/smarty_app/rmitmarket/setup.php'); 
include_once "inc/MyDB.php"; 
include_once "inc/Displayer.php"; //sends header

// Get GET variables containing in the request url;
$action = $_GET['action'];
 
//Now perform specific tasks according to the value of $action;
switch (true) {
	case  (is_null($action)): //If action is null then; index page;			
		$displayer->displayHome();
		break;
 
	case  ($action=="listgroups"): //If action is listgroups then;  groups page
		$displayer->displayGroups();
		break;
 
	case  ($action=="listads"): //If action is listads then; ads page
		$displayer->displayAds();
		break;
			
	case  ($action=="placead"): //If action is placead then; ad place ad page
		$displayer->displayPlaceAdForm(0,0);
		break;	 
 
    case  ($action=="manageAcc"): //If action is manageAcc then; ad manage account page
		$displayer->displayAccManageForm(0,0);
		break;
 
	case  ($action=="postreply"): //If action is postreply then; ad post reply page
		$displayer->displayPostReplyForm(0,0);
		break;
		
	case  ($action=="register"): //If action is showdetails then; ad details page
		$displayer->displayRegisterForm(0,0);
		break;
			 
	case  ($action=="logout"): //If action is logout then; index page
			$session->logout();
			$displayer->displayHome();		 
			break;
			
	case  ($action=="login"): //If action is login then; login page			
		$displayer->displayLoginForm(0,0);
		break;	
 
 	case  ($action=="showdetails"): //If action is showdetails then; ad details page
		$displayer->displayAdDetails();
		break;
			 
	default:
		$displayer->displayHome();
			
}
 