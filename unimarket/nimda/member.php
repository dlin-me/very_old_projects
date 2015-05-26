<?php
include('_config.php');
Page::$attributes['do_history'] = true;
Page::start();


Page::$data['title'] = 'Unisale.com.au - Members';
Page::$data['tag'] = 'member';



Page::setLayout('general_template');


if(Request::paramGet('id') > 0 ){
     Page::$data['COL_MID'] = array('member_detail');
}else{
     Page::$data['COL_MID'] = array('member_list');
}
Page::render();
echo Debug::getInfo();
?>