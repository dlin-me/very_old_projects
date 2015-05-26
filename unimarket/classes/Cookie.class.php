<?php


/**
 * Cookie
 *
 * @package Class
 * @author David
 * @copyright Copyright (c) 2006
 * @version 1.0.0
 * @access public
 **/
 class Cookie{

	// Attributes
	var $name;
	var $site;
	var $last_search_keyword;
	var $last_search_category;
	var $last_category;
	var $last_view; //array

	var $set_info;// flag to determin whether to update cookie
	var $set_history;

	/**
	 * Cookie::Cookie()
	 * Constructor
	 *
	 * @return the cookie object
	 **/
	function Cookie() {

		//load first cookie, user info
		$temp = explode('|', @$_COOKIE['USER_INFO']);
		$this->name = $temp[0];
		$this->site = @$temp[1];

		//load second cookie, user history
		$temp = explode('|', @$_COOKIE['USER_HISTORY']);
		$this->last_search_keyword = @$temp[0];
		$this->last_search_category = intval(@$temp[1]);
		$this->last_category = intval(@$temp[2]);
		$this->last_view = array(intval(@$temp[3]), intval(@$temp[4]), intval(@$temp[5]));

		$this->set_info = false;
		$this->set_history = false;
	}



	/**
	 * Cookie::set_name()
	 * Set cookie for user nick name
	 *
	 * @return
	 **/
	function set_name($name){

		if($this->name != $name){
			$this->name = $name;
			$this->set_info = true;
		}

	}

	/**
	 * Cookie::set_location()
	 * Set cookie for user site
	 *
	 * @return
	 **/
	function set_site($loc){
        $sites = Env::sites();
		if($this->site != $loc && in_array($loc, $sites)){
			$this->site = $loc;
			$this->set_info = true;
		}
	}


	/**
	 * Cookie::set_last_category()
	 * Set cookie for user last visited category
	 *
	 * @return
	 **/
	function set_last_category($cat){

		if($this->last_category != $cat){
			$this->last_category = $cat;
			$this->set_history = true;
		}

	}


	/**
	 * Cookie::set_last_search_keyword()
	 * Set cookie for user last searched keyword
	 *
	 * @return
	 **/
	function set_last_search_keyword($var){

		if($this->last_search_keyword != $var){
			$this->last_search_keyword = $var;
			$this->set_history = true;
		}

	}


	/**
	 * Cookie::set_last_search_category()
	 * Set cookie for user last searched category
	 *
	 * @return
	 **/
	function set_last_search_category($var){

		if($this->last_search_category != $var){
			$this->last_search_category = $var;
			$this->set_history = true;
		}

	}


	/**
	 * Cookie::set_last_view()
	 * Set cookie for user last viewed listing
	 *
	 * @return
	 **/
	function set_last_view($listing_id){

		if(!in_array($listing_id, $this->last_view)){
			//add to the begining
			array_unshift($this->last_view, $listing_id);
			//remove the endding
			array_pop($this->last_view);

			$this->set_history = true;

		}

	}

	/**
	 * Cookie::build()
	 * set cookies if neccessary
	 * This can not be tested localy with localhost
	 * @return
	 **/
	function build(){
		$host = preg_replace('/^[Ww][Ww][Ww]\./', '', preg_replace('/:[0-9]*$/', '', $_SERVER['HTTP_HOST']));

		if($this->set_info){

			$user_info = $this->name.'|'.$this->site;
			//setcookie( 'USER_INFO', $user_info, time()+2592000, '/',  $host , FALSE );

			//this works for localhost
			setcookie("USER_INFO", $user_info, time()+2592000, "/", false);

		}

		if($this->set_history){

			$user_history = $this->last_search_keyword.'|'. $this->last_search_category .'|';
			$user_history .= $this->last_category.'|'.implode('|', $this->last_view);

			//setcookie ( 'USER_HISTORY', $user_history, time() + 2592000, '/',  $host , FALSE );

			//this works for localhost
			setcookie('USER_HISTORY', $user_history, time()+2592000, "/", false);

		}

	}



} //  end of class cookie




?>