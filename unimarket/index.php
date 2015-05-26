<?php
/**
 * index.php
 * This is the front page of the website
 *
 * PHP versions 4
 *
 * @category front
 * @package Unimarket
 * @author David Lin <davidforest@gmail.com>
 * @copyright 2006 UniMarket.net.au
 * @version 1.0.0
 * @since File available since Release 1.0.0
 */
// include global file
include('_config.php');
Page::$attributes['do_history'] = true;
Page::start();

Page::$data['title'] = 'Unisale.com.au';
Page::$data['tag'] = 'home';


Page::$data['COL_LEFT'] = array('pnl_cat_list');
Page::$data['COL_MID'] = array('m_promotion' ,'m_cat_list');
Page::$data['COL_RIGHT'] = array( 'pnl_ad_free', 'pnl_latest_listings');

Page::setLayout('row3col3');
Page::render();
echo Debug::getInfo();
?>
