<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */
class Error{

	private static $e;
	private static $prefix;
	private static $postfix;


    /**
     * Request::getPage()
     *
     * @return the page number user is requesting
     */
    public static function set($errs){
    	self::$e = $errs;

    }

	public static function get($i){
		if(isset(self::$e[$i])){
			return self::$e[$i];
		}
	}


	public static function getMsg($i){

		$prefix = empty(self::$prefix)?'<span class="error">' : self::$prefix;

		$postfix = empty(self::$postfix)?'</span>' : self::$postfix;

		return $prefix.self::get($i).$postfix;

	}


	public static function setPrefix($prefix){
		self::$prefix = $prefix;
	}


	public static function setPostfix($postfix){
		self::$postfix = $postfix;
	}








}

?>