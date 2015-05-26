<?php
include('_config.php');

switch(Request::action()){
    case 'set_site':
        Env::setSite(Request::paramGet('site'));
        $cookie = new Cookie();
        $cookie->set_site(Env::getSite());
        $cookie->build();



        Page::redirect(Request::currentURI());
        break;

    default:
        Page::redirect(Request::currentURI());
} // switch{

?>
