<?php
/**
 * Page
 *
 * @package Class
 * @author David
 * @copyright Copyright (c) 2006
 * @version 1.0.0
 * @access public
 */
class Page{
    // this is the page theme of the current page, the default $theme should be 'default'
    private static $theme;

    // this is the master page of the current page which control the overall layout of the whole page
    private static $layout;

    // this is a set of instructions on how to render a page. i.e. compress, validateion, protected.
    public static $attributes;

    // this is a set of variables that map to page properties such as titel, css, js, meta tags etc.
    public static $data;



    /**
     * Page::Page()
     * Private Constructor
     * Each request needs only one and the same instance of page, therefore the page class is static and should not be instantiated
     *
     * @return the page object
     */
    public function __construct(){
        exit(__class__ . ' can not be instantiated.');
    }

    /**
     * Page::setTheme()
     *
     * @return boolean True if new theme is set
     */
    public static function setTheme($newTheme){
        if(is_dir(THEME_ROOT . '/' . $newTheme)){
            self::$theme = $newTheme;
            return true;
        }else{
            return false;
        }
    }

    /**
     * Page::getTheme()
     *
     * @return the current theme of the page
     */
    public static function getTheme(){
        if(!empty(self::$theme)){
            return self::$theme;
        }else{
            return 'default';
        }
    }

    /**
     * Page::setLayout()
     *
     * @return
     */
    public static function setLayout($layout){
        self::$layout = $layout;
    }

    /**
     * Page::getLayout()
     *
     * @return the layout used by this page
     */
    public static function getLayout(){
        if(!empty(self::$layout)){
            return self::$layout;
        }else{
            return 'row3col3';
        }
    }

    /**
     * Page::setStart()
     *
     * @return mark page start time
     */
    public static function setStartTime(){
        // record the start time of the request
        $_SESSION[APP]['PAGE']['start'] = microtime(true);
    }

    /**
     * Page::getStart()
     *
     * @return the start time when page started
     */
    public static function getStartTime(){
        return $_SESSION[APP]['PAGE']['start'];
    }



    /**
     * Page::start()
     * This is used parse all the page properties before going ahead
     * @return void
     */
    public static function start(){
        // record the page start time
        self::setStartTime();
        //load default
        // if admin password is required
        if(!isset(self::$attributes['require_admin_pass'])){
            self::$attributes['require_admin_pass'] = false;
        }
        // if member password is required
        if(!isset(self::$attributes['require_member_pass'])){
            self::$attributes['require_member_pass'] = false;
        }
        // trace url hisory or not
        if(!isset(self::$attributes['do_history'])){
            self::$attributes['do_history'] = false;
        }

        // update/load cookie or not
        if(!isset(self::$attributes['do_cookie'])){
            self::$attributes['do_cookie'] = false;
        }


        // redirect user to administrator login page
        if(self::$attributes['require_admin_pass']){ //visitor must present the privilege to gain access
               if(!Auth::isAdmin()){
                    self::redirect(ADMIN_LOGIN_PAGE);
               }
        }

        // redirect user to member login page
        if(self::$attributes['require_member_pass']){
               if(!Auth::isMember()){
                    self::redirect(MEMBER_LOGIN_PAGE);
               }

        }

        // record the request uri . i.e. the url being requested
        if(self::$attributes['do_history']){
               Request::record();
        }

        // load cookie into session if cookie exist and havn't been loaded
        if(self::$attributes['do_cookie']){
            //TO DO
        }
    }

    /**
     * Page::prepare()
     * Do some thing before page is return
     *
     * @return void
     */
    private function preRender(){
        // default page title
        if(empty(self::$data['title'])){
            self::$data['title'] = "Search Engine Marketing Optimiser";
        }
        // default page meta keyword
        if(empty(self::$data['meta_keyword'])){
            self::$data['meta_keyword'] = self::$data['title'];
        }
        // default page meta description
        if(empty(self::$data['meta_description'])){
            self::$data['meta_description'] = self::$data['title'];
        }
        if(empty(self::$data['nevigation'])){
            self::$data['nevigation'] = array();
        }


    }



    /**
     * Page::render()
     * get page content and applies page fileter to content before outputing the content
     *
     * @return
     */
    public static function render(){
        self::preRender();


        //Php template method
        ob_start();
        include(TPL_ROOT.'/'.self::$layout.'.php');
        $contents = ob_get_contents();
        ob_end_clean();

        echo $contents;


        self::postRender();
    }



    /**
     * Page::postRender()
     * Extra processing after page render to the browser
     * @return
     */
    private static function postRender(){
        // clearing temporary variable holder, these temporary variables normall exist  between two consecutive request
        self::clearTempData();

    }

    /**
     * Page::setTempData()
     * set the page temporary data, this data will survive till the next render call
     * @param mixed $index
     * @param mixed $value
     * @return
     */
    public static function setTempData($index, $value){
    	if(is_object($value)){
    		exit('Page::setTempData :: Can not set object as page temp data.');
    	}

        if(!isset($_SESSION[APP]['PAGE']['TEMP_DATA'])){
            $_SESSION[APP]['PAGE']['TEMP_DATA'] = array();
        }

        $_SESSION[APP]['PAGE']['TEMP_DATA'][$index] = $value;
    }


    /**
     * Page::getTempData()
     * retrieve temporary data
     * @param mixed $index
     * @return
     */
    public static function getTempData($index){
        if(isset($_SESSION[APP]['PAGE']['TEMP_DATA'][$index])){
            return $_SESSION[APP]['PAGE']['TEMP_DATA'][$index];
        }else{
            return null;
        }
    }

    /**
     * Page::clearPageData()
     * Clear data the current page temporary holds
     *
     * @return
     */
    private function clearTempData(){
        unset($_SESSION[APP]['PAGE']['TEMP_DATA']);
    }


    /**
     * Page::redirect()
     * redirect browser to a nominated url
     * @param mixed $url
     * @return void
     */
    public static function redirect($url){

        if(!headers_sent()){
            header('Location: ' . $url);
            exit;
        }else{
            echo '<meta http-equiv="refresh" content="0; URL=' . $url . '">';
            echo '<script language="javascript" type="text/javascript">
     					<!--
     					window.location="' . $url . '";
     					// -->
 				  </script>';
            exit;
        }
    }


} //  end of class page

?>