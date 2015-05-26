<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */

class CatTable extends Table{


    public function __construct(){

        $this->tblName = 'categories';
        $this->tblIdCol = 'cat_id';

        $this->tblCols = array ('cat_id'=>'Category ID',
            'cat_parent'=>'Parent Category',
            'cat_name'=>'Category Name',
            'cat_img'=>'Category Image',
            'cat_use_price'=>'Use Price',
            'cat_use_datetime'=>'Use Datetime',
            'cat_rank'=>'Category Rank',
            'cat_created'=>'Created Date',
            'cat_updated'=>'Last Updated',
            'cat_recycled'=>'Recycled Date');


        $this->tblEmu['cat_use_price'] = array('1' => 'Yes', '0' => 'No');
        $this->tblEmu['cat_use_datetime'] = array('1' => 'Yes', '0' => 'No');

        $this->tblColRequired = array('cat_name');

        $this->tblCreatedCol = 'cat_created';
        $this->tblUpdatedCol = 'cat_updated';
        $this->tblRecycledCol = 'cat_recycled';
        $this->tblDefaultOrder = array('cat_rank' => 'ASC', 'cat_name'=>'ASC');

        parent::__construct();

    }


    /**
     * Cat::getTree()
     *
     * @return A tree like array refleting the category structure
     */
    public function getTreeIds(){
        $criteria = array();
        $criteria[$this->tblRecycledCol] = 0;
        $res = $this->getRows($criteria);
        RowSet::add('Cat',$res);
        $return = array();
        if(is_array($res)){
            foreach($res as $r=>$dt){
                $return[$dt['cat_parent']][$dt['cat_id']] = $dt['cat_id'];
            }
        }

        return $return;
    }


  //  public function get


    public function getLevelIds($tree, $start_array, $level = 0){
        $return = array();

        foreach ($start_array as $id){
                $return[] = array($id, $level);
                if(isset($tree[$id])){
                    $return = array_merge($return, $this->getLevelIds($tree, $tree[$id], $level+1));
                }
        }

        return $return;

    }


}

?>