<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */
class Request{


    /**
     * Request::getPage()
     *
     * @return the page number user is requesting
     */
    public static function page(){
        return isset($_GET['_p']) && $_GET['_p'] > 0 ? intval($_GET['_p']):1;
    }



    /**
     * Request::getAction()
     *
     * @return the action user is performing
     */
    public static function action(){
        if(!empty($_POST['_a']) ){
            return $_POST['_a'];
        }elseif(!empty($_GET['_a'])){
            return $_GET['_a'];
        }else{
            return '';
        }
    }

	/**
	 * Request::paramGet()
	 * Encapsulate the access to the $_GET variables
	 * @param mixed $name
	 * @return
	 */
	public static function paramGet($name){
		if(isset($_GET[$name])){
			return  $_GET[$name] ;
		}else{
			return null;
		}
	}

	/**
	 * Request::paramPost()
	 * Encapsulate the access to the $_POST variables
	 * @param mixed $name
	 * @return
	 */
	public static function paramPost($name){
		if(isset($_POST[$name])){
			return  $_POST[$name] ;
		}else{
			return null;
		}
	}


    /**
     * Request::URI()
     *
     * @return the request URI
     */
    public static function currentURI(){

        return self::getRecord(0);

    }

    /**
     * Request::lastURI()
     *
     * @return the URI of the last request from this user in the current session
     */
    public static function lastURI(){
        return self::getRecord(1);
    }



    /**
     * Request::record()
     *
     * @return record the request uri
     */
    public static function record(){
        // track page visit
        if(!is_array(@$_SESSION[APP]['REQUEST']['TRACK_PAGE'])){
            $_SESSION[APP]['REQUEST']['TRACK_PAGE'] = array();
        }

        if($_SERVER['REQUEST_URI'] != self::currentURI()){
            // trim the front of the array to the right size
            while (count($_SESSION[APP]['REQUEST']['TRACK_PAGE']) > 3){
                array_pop($_SESSION[APP]['REQUEST']['TRACK_PAGE']);
            }
            array_unshift($_SESSION[APP]['REQUEST']['TRACK_PAGE'], $_SERVER['REQUEST_URI']);
        }

    }

	/**
	 * Request::getRecord()
	 *
	 * @param integer $i
	 * @return string url of the request indexed
	 */
	private static function getRecord($i){
		return isset($_SESSION[APP]['REQUEST']['TRACK_PAGE'][$i]) ? $_SESSION[APP]['REQUEST']['TRACK_PAGE'][$i] : '/';
	}



	/**
	 * Request::cat()
	 *
	 * @return the current category id
	 */
	public static function cat(){
        if(self::paramGet('cid') > 0  && !is_null(RowSet::get('Cat', self::paramGet('cid')))){
            return intval(self::paramGet('cid'));
        }else{
            return 0;
        }
	}

	/**
	 * Request::id()
	 *
	 * @return
	 */
	public static function id(){
        if(self::paramPost('id') > 0) {
            return self::paramPost('id');
        }elseif(self::paramGet('id') > 0) {
            return self::paramGet('id');
        }else{
            return 0;
        }
	}
}

?>