<?php

/**
 * Class Listing
 * This class contains Listing specific implementation
 *
 * @version $Id$
 * @copyright 2007
 */

class Listing extends Row{
    private static $tblObj = null;

    /**
     * Listing::getTblObj()
     * Implement the required method in class Row
     *
     * @return
     */
    public function getTblObj(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new ListingTable();
        }
        return self::$tblObj;
    }

    /**
     * Listing::getTbl()
     * This staic function allows access to the table object without instantiate an Listing object
     *
     * @return
     */
    public static function getTbl(){
        if(is_null(self::$tblObj)){
            self::$tblObj = new ListingTable();
        }
        return self::$tblObj;
    }


    /**
     * Cat::getUrl()
     *
     * @return the url of the current category
     */
    public function getCatObj(){
        return RowSet::get('Cat',$this->cat_id);
    }

    public function getUrl($abs = false){
        $catObj = $this->getCatObj();
        $url = $catObj->getUrl($abs);
        return str_ireplace('_cid', '/' . preg_replace('/[^\d\w]+/', '-', $this->listing_title) . '_lid' . $this->getId(), $url);
    }

    /**
     * Listing::getImageObjs()
     *
     * @return an array of image objects associated with this listing, with the main image as the fisrt element
     */
    public function getImageObjs(){
        $mainObj = $this->getMainImageObj();
        $ids = array();
        $ids[$this->listing_img0] = intval($this->listing_img0);
        $ids[$this->listing_img0] = intval($this->listing_img0);
        $ids[$this->listing_img0] = intval($this->listing_img0);
        $ids[$this->listing_img0] = intval($this->listing_img0);


        if(!is_null($mainObj)){
            $return = array($mainObj);
            if(count($ids) > 0){
                foreach($ids as $id){
                    if($id > 0 && $id != $mainObj->getId()){
                        $return[] = RowSet::get('Image',$id);
                    }
                }
            }
            return $return;
        }else{
            return array();
        }
    }

    /**
     * Listing::getMainImageObj()
     *
     * @return the main image object
     */
    public function getMainImageObj(){
        $main_id = $this->listing_img0;
        if($main_id <= 0){
            $main_id = $this->listing_img1;
        }
        if($main_id <= 0){
            $main_id = $this->listing_img2;
        }
        if($main_id <= 0){
            $main_id = $this->listing_img3;
        }
        if($main_id <= 0){
            $main_id = $this->listing_img4;
        }

        if($main_id <= 0){
            return null;
        }else{
            return RowSet::get('Image', intval($main_id));
        }
    }

    /**
     * Listing::getMenuArray()
     *
     * @return an array that can be used to generate the page titel and menu
     */
    public function getMenuArray(){
        $catObj = $this->getCatObj();
        $return = $catObj->getMenuArray();
        $return[$this->getUrl()] = $this->listing_title;

        return $return;
    }


    public function getThumbUrl(){
        $imageObj = $this->getMainImageObj();
        if($imageObj){
            return $imageObj->getThumbUrl();
        }else{
            return LISTING_IMG_DIR.'/noimage.gif';
        }

    }
}

?>