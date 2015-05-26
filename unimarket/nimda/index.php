<?php
include('_config.php');
Page::$attributes['do_history'] = true;
Page::start();

Page::$data['title'] = 'Unisale.com.au';
Page::$data['tag'] = 'home';


Page::$data['COL_LEFT'] = array('login');
Page::$data['COL_RIGHT'] = array('summary');
Page::setLayout('home_template');
Page::render();
echo Debug::getInfo();
?>