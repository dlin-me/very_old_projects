<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2007
 */

class Validator{

    const REQUIRED = 1; //required field
    const GREATER = 2; // >
    const GREATER_EQUAL = 3;  //>=
    const EQUAL = 4; // ==
    const SMALLER_EQUAL =5; //<=
    const SMALLER = 6; //<
    const OPEN_BETWEEN = 7; // 5 > x >8
    const CLOSE_BETWEEN = 8; // 5 >= x >= 8
    const LEFT_OPEN_BETWEEN = 9; // 5 > x >= 8
    const LEFT_CLOSE_BETWEEN =10; // 5 >= x >8
    const REXP = 11; // /\d/
    const EMAIL = 12;


    public $type;
    public $operants;


    public function __construct($type, $ops=0){
        $this->type = $type;
        $this->operants = $ops;
    }


    public function validate($value){
        switch ($this->type){
            case self::REQUIRED:
                if(empty($value)){
                    return false;
                }
                break;
            case self::GREATER:
                if($value <= $this->operants){
                    return false;
                }
                break;
            case self::GREATER_EQUAL:
                if($value < $this->operants){
                    return false;
                }
                break;
            case self::EQUAL:
                if($value != $this->operants){
                    return false;
                }
                break;

            case self::SMALLER_EQUAL:
                if($value > $this->operants){
                    return false;
                }
                break;
            case self::SMALLER:
                if($value >= $this->operants){
                    return false;
                }
                break;
            case self::OPEN_BETWEEN:
                $this->operants = array_values($this->operants); //make sure it is an arrray and remove index
                sort($this->operants);
                if($value <= $this->operants[0] || $value >= $this->operants[1] ){
                    return false;
                }
                break;

            case self::CLOSE_BETWEEN:
                $this->operants = array_values($this->operants); //make sure it is an arrray and remove index
                sort($this->operants);
                if($value < $this->operants[0] || $value > $this->operants[1] ){
                    return false;
                }
                break;

            case self::LEFT_OPEN_BETWEEN:
                $this->operants = array_values($this->operants); //make sure it is an arrray and remove index
                sort($this->operants);
                if($value <= $this->operants[0] || $value > $this->operants[1] ){
                    return false;
                }
                break;

            case self::LEFT_CLOSE_BETWEEN:
                $this->operants = array_values($this->operants); //make sure it is an arrray and remove index
                sort($this->operants);
                if($value < $this->operants[0] || $value >= $this->operants[1] ){
                    return false;
                }
                break;

            case self::REXP:
                if(!preg_match($this->operants, $value)){
                    return false;
                }
                break;

            case self::EMAIL:
                if(!$this->isEmail($value)){
                    return false;
                }
        }

        return true;

    }


    private function isEmail($email){
        // the following is a more strict alternative
        // return !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$", trim($email));
        $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';

        $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';

        $atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c' . '\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';

        $quoted_pair = '\\x5c[\\x00-\\x7f]';

        $domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";

        $quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";

        $domain_ref = $atom;

        $sub_domain = "($domain_ref|$domain_literal)";

        $word = "($atom|$quoted_string)";

        $domain = "$sub_domain(\\x2e$sub_domain)*";

        $local_part = "$word(\\x2e$word)*";

        $addr_spec = "$local_part\\x40$domain";

        return preg_match("!^$addr_spec$!", $email) ? true : false;
    }



}
?>