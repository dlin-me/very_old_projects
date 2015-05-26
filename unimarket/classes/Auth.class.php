<?php


/**
 * Auth
 * This class encapsurate the authorisation functionalities
 * @package
 * @author Administrator
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class Auth{

    /**
     * Auth::isAdmin()
     *
     * @return boolean, whether current user is an administrator
     */
    public static function isAdmin(){
        return false;

    }

    /**
     * Auth::isMember()
     *
     * @return boolean, whether current user is a member
     */
    public static function isMember(){
        return false;

    }

    /**
     * Auth::id()
     *
     * @return the Id of the current user no matter he is an administrator or a member
     */
    public static function getId(){
        if(isset($_SESSION[APP]['AUTH']['MEMBER'])){
            return $_SESSION[APP]['AUTH']['MEMBER'];
        }else{
            return 0;
        }
    }


    /**
     * Auth::loginAdmin()
     *
     * @return boolean, sucessiful or not logged in as an administrator
     */
    public static function loginAdmin($credentials){
        //to do

    }


    /**
     * Auth::loginMember()
     *
     * @return boolean, sucessiful or not the logged in as a member
     */
    public static function loginMember($credentials){
        //to do

    }


    public static function logFailedAttempt(){
        //to do

    }


}

?>