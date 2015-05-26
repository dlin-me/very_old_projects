<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */

class MessageTable extends Table{


    public function __construct(){
        $this->tblName = 'messages';
        $this->tblIdCol = 'msg_id';
        $this->tblCols = array('msg_id'=>'Message ID',

            'msg_mem_from'=>'Sender', //the one who Ask the question
            'msg_mem_to'=>'Receiver',
            'listing_id'=>'Related Listing ID',// all msg must be related to an listing

            'msg_reply_to'=>'Message ID Being Reply', //if 0 this is a question
            'msg_title'=>'Quesetion Title',//subject
            'msg_detail'=>'Message Detail',
            'msg_status'=>'Message Status',//new, read, deleted, replied
            'msg_created'=>'Created Time',
            'msg_updated'=>'Updated Time',
            'msg_recycled'=>'Recycled Time');

        $this->tblForeignCols['listing_id'] = array('listings', 'listing_id');
        $this->tblForeignCols['msg_mem_ask'] = array('members', 'mem_id'); //note: image table foreign fields are ignored
        $this->tblForeignCols['msg_mem_asked'] = array('members', 'mem_id');
        $this->tblForeignCols['as_id'] = array('answers', 'as_id');

        $this->tblEnum['msg_status'] = array('new'=>'New', 'read'=>'Read', 'deleted'=>'Deleted', 'replied'=>'Replied');

        $this->tblCreatedCol = 'msg_created';
        $this->tblUpdatedCol = 'msg_updated';
        $this->tblRecycledCol = 'msg_recycled';
        $this->tblDefaultOrder = array('msg_created' => 'DESC');
        parent::__construct();
    }


}

?>