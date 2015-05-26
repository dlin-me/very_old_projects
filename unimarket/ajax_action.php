<?php
include('_config.php');

switch(Request::action()){
    case 'quote_create_search_cst_dropdown':

    default:
        Page::redirect(Request::currentURI());
}

?>
