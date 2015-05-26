<?php

/**
 * Class RowSet
 * This class holds a collection of Row objects
 *
 * @version $Id$
 * @copyright 2007
 */

class RowSet{
    private static $Buffer;

    /**
     * RowSet::setRows()
     *
     * @param mixed $array multi-row array
     * @return array of ID added
     */
    public static function add($class_name, array $rows){
        $tblObj = call_user_func(array($class_name, "getTbl"));

        $return = array();
        foreach($rows as $dt){
            if(isset($dt[$tblObj->tblIdCol]) && $dt[$tblObj->tblIdCol] > 0){
                if(!isset(self::$Buffer[$class_name][$dt[$tblObj->tblIdCol]])){
                    $obj = new $class_name();
                    $obj->setRawData($dt);
                    self::$Buffer[$class_name][$dt[$tblObj->tblIdCol]] = $obj;
                }
                $return[] = $dt[$tblObj->tblIdCol];
            }
        }
        return $return;
    }

    /**
     * RowSet::getRow()
     *
     * @param mixed $id
     * @return Row object of specified by the id
     */
    public static function get($class_name, $id = 0){
        if(!isset(self::$Buffer[$class_name][$id])){
            $obj = new $class_name();
            if($id == 0){
                return $obj;
            }else{
                $res = $obj->loadData($id);
            }
            if($res){
                self::$Buffer[$class_name][$id] = $obj;
            }else{
                return null;
            }
        }

        return self::$Buffer[$class_name][$id];
    }
}

?>