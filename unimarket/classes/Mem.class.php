<?php

/**
 * Class Mem
 * This class contains Mem specific implementation
 *
 * @version $Id$
 * @copyright 2007
 */

class Mem extends Row{
    private static $tblObj = null;

    /**
     * Mem::getTblObj()
     * Implement the required method in class Row
     *
     * @return
     */
    public function getTblObj(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new MemTable();
        }
        return self::$tblObj;
    }

    /**
     * Mem::getTbl()
     * This staic function allows access to the table object without instantiate an Mem object
     *
     * @return
     */
    public static function getTbl(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new MemTable();
        }
        return self::$tblObj;
    }


    function packData(){
        $data = $this->data;
        if($data['mem_password'] != ''){
             $cryptObj = new Mcrypt();
             $data['mem_password'] =$cryptObj->encrypt($data['mem_password']);
        }
        return $data;
    }


    function unpackData($data){
        if($data['mem_password'] != ''){
             $cryptObj = new Mcrypt();
             $data['mem_password'] =$cryptObj->decrypt($data['mem_password']);
        }

        return $data;
    }






}

?>