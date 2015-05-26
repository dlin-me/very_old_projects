<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */
/**
 * Err
 *
 * @package
 * @author Administrator
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class Err{

	private $e;
	private static $prefix;
	private static $postfix;


    /**
     * Request::getPage()
     *
     * @return
     */
    public function set(Array $errs){
    	self::$e = $errs;

    }

	/**
	 * Err::get()
	 *
	 * @param mixed $i
	 * @return
	 */
	public function get($i){
		if(isset(self::$e[$i])){
			return self::$e[$i];
		}else{
			return null;
		}
	}


	/**
	 * Err::isEmpty()
	 *
	 * @return boolean if there is error
	 */
	public function isEmpty(){
		return empty($this->e);
	}



	/**
	 * Err::getMsg()
	 *
	 * @param mixed $i
	 * @return String formatted error message
	 */
	public function getMsg($i){

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