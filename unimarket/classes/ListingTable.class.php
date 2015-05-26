<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */

class ListingTable extends Table{


    public function __construct(){
        $this->tblName = 'listings';
        $this->tblIdCol = 'listing_id';
        $this->tblCols = array(
            //listing identification fields
            'listing_id'=>'Listing ID',
            'mem_id'=>'Member',
            'cat_id'=>'Category',
            'listing_site'=>'Site',

            //listing description fields
            'listing_title'=>'Title',
            'listing_desc'=>'Description',
            'listing_img0'=>'Primary Image', //this is the main image id, could be one of the ids stored in listing_img1-4
            'listing_img1'=>'Image 1',
            'listing_img2'=>'Image 2',
            'listing_img3'=>'Image 3',
            'listing_img4'=>'Image 4',

             //category specific fields
            'listing_price'=>'Price Field', // content exist if cat_use_pirce is true,
            'listing_event_start'=>'Event Start Time', //timestamp if cat_use_datetime is true
             //member specific fields
            'listing_location'=>'Subject Location', //map to member default location
            'listing_contact_details'=>'Contact Details',
             //listing status fields
            'listing_expiry'=>'Expiry', // determine if this is expired
            'listing_status'=>'Status', // editorial status
             //time related fields
            'listing_created'=>'Created Time',
            'listing_updated'=>'Updated Time',
            'listing_recycled'=>'Recycled Time');

        $this->tblForeignCols['cat_id'] = array('categories', 'cat_id');
        $this->tblForeignCols['mem_id'] = array('members', 'mem_id'); //note: image table foreign fields are ignored

        $this->tblEmu['listing_site'] = Env::sites();
        $this->tblEmu['listing_status'] = array('good' => 'Good Listing','miscategorized'=>'Miscategorized',  'spam_overpost'=>'Spam/Overpost', 'prohibited'=>'Prohibited');

        $this->tblCreatedCol = 'listing_created';
        $this->tblUpdatedCol = 'listing_updated';
        $this->tblRecycledCol = 'listing_recycled';
        $this->tblDefaultOrder = array('listing_updated' => 'DESC');
        parent::__construct();
    }


}

?>