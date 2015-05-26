<?php
include('_config.php');
Page::$attributes['do_history'] = true;
Page::start();


Page::$data['title'] = 'Unisale.com.au - Listing';;
Page::$data['tag'] = 'listing';



Page::setLayout('general_template');


if(Request::paramGet('id') > 0 ){
     Page::$data['COL_MID'] = array('listing_detail');
}else{
     Page::$data['COL_MID'] = array('listing_list');
}
Page::render();
echo Debug::getInfo();
?>