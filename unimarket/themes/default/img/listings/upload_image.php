<?php
/**
 * post.php
 * This is the detail page of a listing
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
include ('../../inc/global.php');
include_once(WEB_ROOT."/inc/class/class.ImageUpload.php");
$id = $_GET['i'];
if( isset($_SESSION['MEM']) && $id > 0){
 $uploadObj = new ImageUpload();
 $res = $uploadObj->loadData($id);
 if($res && $uploadObj->data['mem_id'] == $_SESSION['MEM']['mem_id'] ){
    header("Content-Type: ".$uploadObj->data['iu_type']);
        echo $uploadObj->data['iu_content']; exit;
 }

}



?>