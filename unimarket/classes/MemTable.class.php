<?php

/**
 *
 * @version $Id$
 * @copyright 2007
 */

class MemTable extends Table{

    public function __construct(){

        $this->tblName = 'members';
        $this->tblIdCol = 'mem_id';

        $this->tblCols = array ('mem_id'=>'ID',
            'mem_site'=>'Default Site', // this is the default site for the member,
            'mem_nickname'=>'Nick Name',
            'mem_email'=>'Email',
            'mem_password'=>'Password',
            'mem_token'=>'Register Token',
            'mem_status'=>'Current Status', //banned, new, inoymouse
            'mem_last_login'=>'Last Log in Time',
            'mem_last_namechange'=>'Last Change of Name',
                //preference
            'mem_email_subscription'=>'Subscribe to UniSale Newsletter?',
            'mem_location'=>'Default Location',
            'mem_contact_detail'=>'Default Contact Detail',
            'mem_how_contact'=>'How Buyers Contact You?',
            'mem_created'=>'Registered Since',
            'mem_updated'=>'Last Update',
            'mem_recycled'=>'Recycled Time');


        $this->tblEmu['mem_status'] = array('Anonymous' => 'Anonymous', 'Active' => 'Active', 'Suspended'=>'Suspended');
        $this->tblEmu['mem_site'] = Env::sites();
        $this->tblEmu['mem_email_subscription'] = array('0'=>'No', '1'=>'Yes');
        $this->tblEmu['mem_how_contact'] = array('registered'=>'Registered Buyers See My Contact Detail', 'system'=>'Buyers Contact Me Via UniSale Message System');

        $this->tblCreatedCol = 'mem_created';
        $this->tblUpdatedCol = 'mem_updated';
        $this->tblRecycledCol = 'mem_recycled';
        $this->tblDefaultOrder = array('mem_created' => 'DESC');

        $this->tblValidateRules = array('mem_email'=>Validator::EMAIL);
        parent::__construct();

    }



}

?>