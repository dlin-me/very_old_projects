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
// page settings
Page::$attributes['do_history'] = true;
Page::start();

$catObj = RowSet::get('Cat',Request::cat());

Page::$data['title'] = Page::$data['nevigation'] = $catObj->getMenuArray();

Page::$data['tag'] = 'post';

Page::$data['COL_LEFT'] = array('pnl_cat_list');
Page::$data['COL_MID'] = array('m_listing_list');
Page::$data['COL_RIGHT'] = array( );//should show ads


Page::setLayout('row3col3');
Page::render();
echo Debug::getInfo();

?>