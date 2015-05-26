<?php

class Process{
	private $name;

    public function __construct($name){
        $this->name = $name;
    }

    /**
     * Process::factory()
     * Statically create an Process object
     * @param mixed $name
     * @return
     */
    public static function factory($name){

    	$obj =  new Process($name);
    	return $obj;
    }

    public function clear(){

         unset($_SESSION[APP]['PROCESS'][$this->name]);
    }

    private function __get($name){
		if (!isset($_SESSION[APP]['PROCESS'][$this->name][$name])) {
			return null;
		}else{
        	return $_SESSION[APP]['PROCESS'][$this->name][$name];
        }
    }

    private function __set($name, $value){
        $_SESSION[APP]['PROCESS'][$this->name][$name] = $value;
    }

    private function __unset($name){
        unset($_SESSION[APP]['PROCESS'][$this->name][$name]);
    }



    private function __isset($name){
        return isset($_SESSION[APP]['PROCESS'][$this->name][$name]);
    }

}

?>