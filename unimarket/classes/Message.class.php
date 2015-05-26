<?php

/**
 * Class Message
 * This class contains Message specific implementation
 *
 * @version $Id$
 * @copyright 2007
 */

class Message extends Row{
    private static $tblObj = null;

    /**
     * Message::getTblObj()
     * Implement the required method in class Row
     *
     * @return
     */
    public function getTblObj(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new MessageTable();
        }
        return self::$tblObj;
    }

    /**
     * Message::getTbl()
     * This staic function allows access to the table object without instantiate an Message object
     *
     * @return
     */
    public static function getTbl(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new MessageTable();
        }
        return self::$tblObj;
    }


}

?>