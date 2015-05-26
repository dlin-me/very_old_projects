<?php
include('_config.php');
Page::$attributes['do_history'] = true;
Page::start();


Page::$data['title'] = 'Unisale.com.au - Category';
Page::$data['tag'] = 'category';



Page::setLayout('general_template');


if(Request::paramGet('id') > 0 ){
     Page::$data['COL_MID'] = array('cat_detail');
}else{
     Page::$data['COL_MID'] = array('cat_list');
}
Page::render();
echo Debug::getInfo();
?>