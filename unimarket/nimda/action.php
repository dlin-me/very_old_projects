<?php
include('_config.php');
// my start page with auth requirement
switch(Request::action()){
    case 'category_update':
        if(Request::id() > 0){
            $catObj = RowSet::get('Cat', Request::id());
            $catObj->setData(Request::paramPost('categories'));
            $res = $catObj->update();
            if($res){
                Page::setTempData('MSG', 'Category Updated');
            }else{
                Page::setTempData('MSG', 'No Change Made');
            }
        }
        Page::redirect(Request::currentURI());
        break;
    case 'category_create':
        if(is_array(Request::paramPost('categories'))){
            $catObj = RowSet::get('Cat');
            $catObj->setData(Request::paramPost('categories'));
            $res = $catObj->create();
            if($res){
                Page::setTempData('MSG', 'Category Created');
            }else{
                Page::setTempData('MSG', 'No Change Made');
            }
        }
        Page::redirect(Request::currentURI());
        break;
    case 'category_recycle':
        if(Request::id() > 0){
            $catObj = RowSet::get('Cat', Request::id());

            $res = $catObj->recycle();
            if($res){
                Page::setTempData('MSG', 'Category Recycled');
            }else{
                Page::setTempData('MSG', 'No Change Made');
            }
        }
        Page::redirect(Request::currentURI());
        break;
    case 'member_update':
        if(Request::id() > 0){
            $memObj = RowSet::get('Mem', Request::id());
            $memObj->setData(Request::paramPost('members'));
            $res = $memObj->update();
            if($res){
                Page::setTempData('MSG', 'Member Updated');
            }else{
                Page::setTempData('MSG', 'No Change Made');
            }
        }
        Page::redirect(Request::currentURI());
        break;
    case 'member_bulk_change':
        if(count(Request::id()) > 0){
            foreach(Request::id() as $id){
                $memObj = RowSet::get('Mem', $id);

                if(Request::paramPost('submit') == 'Set Status'){
                    $memObj->setData(Request::paramPost('members'));
                    $res = $memObj->update();
                }elseif(Request::paramPost('submit') == 'Recycle'){
                    $res = $memObj->recycle();
                }else{
                    $res = null;
                }
                if($res){
                    Page::setTempData('MSG', 'Member Updated');
                }else{
                    Page::setTempData('MSG', 'No Change Made');
                }
            }
        }
        Page::redirect(Request::currentURI());
        break;
    default:
        Page::redirect(Request::currentURI());
} // switch{

?>
