<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */

class Env{

    //Site info

    public static function sites(){
        return array("VIC"=>"VIC", "NT"=>"NT", "QLD"=>"QLD", "NSW"=>"NSW", "SA"=>"SA", "TAS"=>"TAS", "WA"=>"WA");
    }

    public static function getSite(){
        $sites =  self::sites();
        if(isset($_SESSION[APP]['ENV']['site']) && in_array($_SESSION[APP]['ENV']['site'], $sites)){

        }else{
            $cookie = new Cookie();
            if(in_array($cookie->site, $sites)){
                $_SESSION[APP]['ENV']['site'] = $cookie->site;
            }else{
                $_SESSION[APP]['ENV']['site'] = $sites['VIC'];
            }
        }

        return  $_SESSION[APP]['ENV']['site'];
    }

    public static function setSite($site){
         $sites =  self::sites();
        if(in_array($site, $sites)){
                $_SESSION[APP]['ENV']['site']=$site;
        }
    }




}

?>