<?php

/**
 * Format
 *
 * @package
 * @author Administrator
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class Format{
    // define time format
    const FORMAT_DATE_TIME = "%d/%m/%y, %H:%M:%S";
    const FORMAT_DATE = "%d/%m/%y";
    const FORMAT_TIME = "%H:%M:%S";

    /**
     * Format::strMoney()
     *
     * @param mixed $string
     * @param mixed $useShort
     * @param string $currency
     * @return Money string
     */
    public static function strMoney($string, $useShort = false, $currency = '$'){
        if(!is_numeric($string)){
            return $string;
        }
        $str = number_format($string, 2, '.', ',');
        if($useShort){
            return $str;
        }else{
            return $currency . $str;
        }
    }

    /**
     * Format::dateShort()
     *
     * @param mixed $timestamp
     * @return formatted short date string;
     */
    public static function strDate($timestamp){
        if($timestamp > 0 ){
            return strftime(self::FORMAT_DATE, $timestamp);
        }else{
            return '';
        }

    }

    /**
     * Format::strTime()
     *
     * @return formated time
     */
    public static function strTime($timestamp){
        if($timestamp > 0 ){
            return strftime(self::FORMAT_TIME, $timestamp);
        }else{
            return '';
        }

    }

    /**
     * Format::strDateTime()
     *
     * @return
     */
    public static function strDateTime($timestamp){
        if($timestamp > 0 ){
            return strftime(self::FORMAT_DATE_TIME, $timestamp);
        }else{
            return '';
        }
    }
    /**
     * Format::numDecimal()
     *
     * @return formated decimal number, default 2 digit
     */
	public static function numDecimal($num){
        return intval(round($num * 100)) / 100;
    }

    /**
     * Format::strTruncate()
     *
     * @param mixed $str
     * @param mixed $len
     * @return
     */
    public static function strTruncate($str, $len){
        $strlen = strlen($str);
        if($len > $strlen){
            return $str;
        }else{
            return substr($str, 0, $len-3).'...';
        }
    }

}

?>