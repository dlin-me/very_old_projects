<?php

/**
 * Class Cat
 * This class contains Cat specific implementation
 *
 * @version $Id$
 * @copyright 2007
 */

class Cat extends Row{
    private static $tblObj = null;

    /**
     * Cat::getTblObj()
     * Implement the required method in class Row
     *
     * @return
     */
    public function getTblObj(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new CatTable();
        }
        return self::$tblObj;
    }

    /**
     * Cat::getTbl()
     * This staic function allows access to the table object without instantiate an Cat object
     *
     * @return
     */
    public static function getTbl(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new CatTable();
        }
        return self::$tblObj;
    }

    /**
     * Cat::getChildrenIds()
     *
     * @return an array of category ids that are children of the current category
     */
    public function getChildrenIds(){
        $tree = self::getTbl()->getTreeIds();
        $id = intval($this->getId());
        if(isset($tree[$id])){
            return $tree[$id];
        }else{
            return array();
        }
    }

    /**
     * Cat::hasChildren()
     *
     * @return boolean if the current category has child or not
     */
    public function hasChildren(){
        $tree = self::getTbl()->getTreeIds();
        $id = $this->getId();
        return isset($tree[$id]);
    }

    public function hasParent(){
        return $this->cat_parent > 0;
    }

    /**
     * Cat::getSiblings()
     *
     * @return the sibling category of the current category
     */
    public function getSiblingIds($include_self = true){
        $tree = self::getTbl()->getTreeIds();
        $parent = $this->getParentId();

        $return = $tree[$parent];
        if(!$include_self){
            $id = $this->getId();
            unset($return[$id]);
        }
        return $return;
    }

    /**
     * Cat::getParent()
     *
     * @return the id of the parent catgegory of the current category
     */
    public function getParentObj(){
        if($this->cat_parent == 0){
            return null;
        }else{
            return RowSet::get('Cat', $this->cat_parent);
        }
    }

    /**
     * Cat::getParent()
     *
     * @return the id of the parent catgegory of the current category
     */
    public function getParentId(){
        return intval($this->cat_parent);
    }

    /**
     * Cat::getAncestors()
     *
     * @return an array of ancestors
     */
    public function getAncestorObjs(){
        $obj = $this;
        $return = array();

        while(!is_null($obj->getParentObj())){
            $obj = $obj->getParentObj();
            $return[] = $obj;
        }

        return array_reverse($return);
    }

    /**
     * Cat::getUrl()
     *
     * @return the url of the current category
     */
    public function getUrl($abs = false){
        $parents = $this->getAncestorObjs();
        $url = '';

        foreach ($parents as $obj){
            $url .= '/' . preg_replace('/[^\d\w]+/', '-', $obj->cat_name);
        }

        $url .= '/' . preg_replace('/[^\d\w]+/', '-', $this->cat_name) . '_cid' . $this->getId() . '.html';

        return $abs? DOMAIN_NAME . WEB_DIR. $url:WEB_DIR.$url;
    }

    /**
     * Cat::getMenuArray()
     *
     * @return an array used to generate the page title and the menu
     */
    public function getMenuArray(){
        $parents = $this->getAncestorObjs();
        $return = array();
        foreach($parents as $obj){
            $return[$obj->getUrl()] = $obj->cat_name;
        }
        if($this->cat_name){//incase of empay object
            $return[$this->getUrl()] = $this->cat_name;
        }
        return $return;
    }


    public static function getLevelIds($tree, $start_array, $level = 0){
        $return = array();

        foreach ($start_array as $id){
                $return[] = array($id, $level);
                if(isset($tree[$id])){
                    $return = array_merge($return, self::getLevelIds($tree, $tree[$id], $level+1));
                }
        }

        return $return;

    }





}

?>