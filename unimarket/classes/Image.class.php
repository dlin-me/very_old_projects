<?php

/**
 * Class Image
 * This class contains Image specific implementation
 *
 * @version $Id$
 * @copyright 2007
 */

class Image extends Row{
    private static $tblObj = null;
    private $file = null;//uploaded file to store

    /**
     * Image::getTblObj()
     * Implement the required method in class Row
     *
     * @return
     */
    public function getTblObj(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new ImageTable();
        }
        return self::$tblObj;
    }

    /**
     * Image::getTbl()
     * This staic function allows access to the table object without instantiate an Image object
     *
     * @return
     */
    public static function getTbl(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new ImageTable();
        }
        return self::$tblObj;
    }



    public function getExt(){
        return $this->img_ext;

    }

    public function getUrl($abs=false){
        if($this->img_external_url != ''){
            return $this->img_external_url;
        }
        return $abs? DOMAIN_NAME.LISTING_IMG_DIR.'/'.$this->getId().'.'.$this->getExt():LISTING_IMG_DIR.'/'.$this->getId().'.'.$this->getExt();
    }

    public function getThumbUrl( $w=60, $h=60){//always relative
        if($this->img_external_url != ''){
            return $this->img_external_url;
        }
        return PHPTHUMB_DIR.LISTING_IMG_DIR.'/'.$this->getId().'.'.$this->getExt().'&w='.$w.'&h='.$h.'&zc=1';

    }

    public function getPath(){
        return LISTING_IMG_ROOT.'/'.$this->getId().'.'.$this->getExt();
    }

    /**
     * Image::setFile()
     * set the uploaded image file
     * @param mixed $file
     * @return void
     */
    public function setFile($file=null){
        if(is_array($file)){
            $this->file=$file;
        }else{
            $this->file = null;
        }
    }


    function remove(){
        $res = parent::remove();
        if($res && file_exists($this->getPath())){
            return unlink($this->getPath());
        }else{
            return $res;
        }
    }

    /**
     * Image::create()
     *
     * @return an image must have a file to create
     */
    function create(){
        if($this->img_external_url != ''){
            return parent::create();

        }elseif( isset($this->file['tmp_name']) && isset($this->file["error"]) && $this->file["error"]==UPLOAD_ERR_OK ){
            $res = move_uploaded_file($this->file['tmp_name'], $this->getPath());
            if($res){
                return parent::create();
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



}

?>