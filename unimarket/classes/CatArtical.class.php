<?php

/**
 * Class CatArticle
 * This class contains CatArticle specific implementation
 * Cat articles are buyer/seller guides providing info to users
 * @version $Id$
 * @copyright 2007
 */

class CatArticle extends Row{
    private static $tblObj = null;

    /**
     * CatArticle::getTblObj()
     * Implement the required method in class Row
     *
     * @return
     */
    public function getTblObj(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new CatArticleTable();
        }
        return self::$tblObj;
    }

    /**
     * CatArticle::getTbl()
     * This staic function allows access to the table object without instantiate an CatArticle object
     *
     * @return
     */
    public static function getTbl(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new CatArticleTable();
        }
        return self::$tblObj;
    }


}

?>