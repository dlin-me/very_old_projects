<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */

class ImageTable extends Table{


    public function __construct(){

        $this->tblName = 'images';
        $this->tblIdCol = 'img_id';

        $this->tblCols = array ('img_id'=>'Image ID',
            'img_name'=>'Image Name',
            'img_ext'=>'Image Extension',
            'img_ext'=>'Image Extension',
            'img_external_url'=>'Image External URL',
            'img_created'=>'Created Time',
            'img_updated'=>'Updated Time',
            'img_recycled'=>'Recycled Time');

        $this->tblEmu['img_ext'] = array('gif' => 'gif', 'bmp' => 'bmp', 'jpg'=>'jpg', 'jpeg'=>'jpeg');

        $this->tblCreatedCol = 'img_created';
        $this->tblUpdatedCol = 'img_updated';
        $this->tblRecycledCol = 'img_recycled';
        $this->tblDefaultOrder = array('img_created' => 'DESC');


        parent::__construct();


    }



}

?>