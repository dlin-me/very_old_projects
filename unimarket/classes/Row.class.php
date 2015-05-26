<?php

/**
 * Row
 *
 * @package
 * @author Administrator
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
abstract class Row{
    public $data;
    public $funcCache; //this is used for fucntion call cache
    public $errObj;

    public function __construct(){
        $this->data = array();
        $this->errObj = null;
    }

    /**
     * Row::callCacheFunc()
     * To get Real benefit, the cache function must be quite costly
     *
     * @param mixed $func_name
     * @return mixed
     */
    public function callCacheFunc($func_name){
        if(method_exists ($this, $func_name)){
            // gets the arguments
            $arg_list = func_get_args();
            $arg_list = array_shift($arg_list);

            if(!isset($this->funcCache[get_class($this)][$func_name . serialize($arg_list)])){
                $result = call_user_func_array(array($this, $func_name), $arg_list);
                $this->funcCache[get_class($this)][$func_name . serialize($arg_list)] = $result;
            }

            return $this->funcCache[get_class($this)][$func_name . serialize($arg_list)];
        }else{
            exit('Call to undefined method ' . get_class($this) . '::' . $func_name);
        }
    }

    /**
     * Row::getTblObj()
     *
     * @return Table Object
     */
    abstract public function getTblObj();

    /**
     * Row::getTbl()
     *
     * @return Table Object
     */
    abstract public static function getTbl();
    /**
     * Row::packData()
     * must return the data set of the current row in the right format for the database, e.g. date format , serialisation
     * to be overide
     *
     * @return
     */
    public function packData(){
        return $this->data;
    }

    /**
     * Row::unpackData()
     * provide a routine to translate data from the database to something more meaningful to human, e.g. date format, unserialisation
     * To be override
     *
     * @param mixed $data
     * @return
     */
    public function unpackData($data){
        return $data;
    }

    /**
     * Row::__get()
     * Row field data accessor
     *
     * @param mixed $name
     * @return
     */
    public function __get($name){
        $tblObj = $this->getTblObj();
        if(isset($this->data[$name])){
            return $this->data[$name];
        }elseif(array_key_exists($name, $tblObj->tblCols)){
            return null;
        }else{
            exit('Property ' . $name . ' not available.');
        }
    }

    /**
     * Row::__set()
     * Row field data mutator
     *
     * @param mixed $name
     * @param mixed $value
     * @return
     */
    public function __set($name, $value){
        $tblObj = $this->getTblObj();
        if(array_key_exists($name, $tblObj->tblCols)){
            $this->data[$name] = $value;
        }else{
            exit('Property ' . $name . ' does not exist.');
        }
    }

    /**
     * Row::loadData()
     *
     * @param mixed $id
     * @return
     */
    public function loadData($id){
        $tblObj = $this->getTblObj();
        $data = $tblObj->getRowById($id);
        if(!empty($data)){
            $this->setRawData($data);
            return true;
        }else{
            return false;
        }
    }

    /**
     * Row::getId()
     *
     * @return the id for this row
     */
    public function getId(){
        $tblObj = $this->getTblObj();
        return isset($this->data[$tblObj->tblIdCol]) ? $this->data[$tblObj->tblIdCol] : null;
    }

    /**
     * Row::setId()
     * Sets the id of this row, this is normally an action after creating a new row
     *
     * @param mixed $id
     * @return
     */
    public function setId($id){
        $tblObj = $this->getTblObj();
        $this->data[$tblObj->tblIdCol] = $id;
    }

    /**
     * Row::getData()
     *
     * @param mixed $col
     * @return the data of the given col in this row
     */
    public function getData($col){
        return isset($this->data[$col]) ? $this->data[$col] : null;
    }

    /**
     * Row::setData()
     *
     * @param mixed $value_pair
     * @return
     */
    public function setData(array $value_pair){
        foreach($value_pair as $col => $value){
            if(is_string($value)){
                $value = trim($value);
            }
            $this->setCol($col, $value);
        }
        return true;
    }

    /**
     * Row::setRawData()
     *
     * @param mixed $value_pair
     * @return
     */
    public function setRawData(array $value_pair){
        $value_pair = $this->unpackData($value_pair);
        return $this->setData($value_pair);
    }

    public function setCol($col, $value){
        $tblObj = $this->getTblObj();
        if(isset($col, $tblObj->tblCols)){
            $this->data[$col] = $value;
            return true;
        }else{
            return false;
        }
    }
    public function create(){
        $myTable = $this->getTblObj();
        $data = $this->packData();

        return $myTable->createRow($data);
    }

    public function remove(){
        $myTable = $this->getTblObj();
        return $myTable->removeRowById($this->getId());
    }

    public function recycle(){

        $myTable = $this->getTblObj();
        return $myTable->recycleRow($this->getId());
    }

    public function restore(){
        $myTable = $this->getTblObj();
        return $myTable->restoreRow($this->getId());
    }

    public function duplicate(){ // protential danger of breaking the column index rules
        $myTable = $this->getTblObj();
        return $myTable->duplicateRowById($this->getId());
    }

    public function update(array $data = array()){
        if(!empty($data)){
            $this->setData($data);
        }

        $myTable = $this->getTblObj();
        $mydata = $this->packData();
        return $myTable->updateRow($this->getId(), $mydata);
    }

    public function validate(){
        $myTable = $this->getTblObj();
        $mydata = $this->packData();
        return $myTable->getErrors($mydata);
    }
    // Following function provide administration fields
    public function getFieldName($field){
        $myTable = $this->getTblObj();
        if(isset($myTable->tblCols[$field])){
            return $myTable->tblCols[$field];
        }else{
            return $field;
        }
    }

    public function getFieldHTML($field){
        $myTable = $this->getTblObj();

        switch(true){
            // if it is id field, show label
            case $field == $myTable->tblIdCol:
                return $this->$field;
                // if it is created, recyced, updated field, show date formatted label
            case $field == $myTable->tblCreatedCol:
            case $field == $myTable->tblUpdatedCol:
            case $field == $myTable->tblRecycledCol:
                return Format::strDateTime($this->$field);

            case isset($myTable->tblEmu[$field]):
                $params = array();
                $params['name'] = $myTable->tblName . '[' . $field . ']';
                $params['id'] = $field;
                $params['options'] = $myTable->tblEmu[$field];
                $params['value'] = $this->$field;
                return Control::htmlSelect($params);

            default:
                $params = array();
                $params['name'] = $myTable->tblName . '[' . $field . ']';
                $params['id'] = $field;
                $params['value'] = $this->$field;
                return Control::htmlTextbox($params);
        } // switch
    }

    public function getFieldControl($field, $control_name){
        $myTable = $this->getTblObj();
        $params = array();
        $params['name'] = $myTable->tblName . '[' . $field . ']';
        $params['id'] = $field;
        $params['value'] = $this->$field;

        if(method_exists('Control',$control_name) ){
            return call_user_func(array('Control', $control_name), $params);
        }
    }
}

?>