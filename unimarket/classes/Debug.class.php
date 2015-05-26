<?php


class Debug{

    /**
     * Debug::handleError()
     *
     * @param mixed $errObj
     * @return
     */
    public static function handleError($errObj, $ref=null){
        switch(get_class($errObj)){
            case 'PDOException':
                exit ('Connection failed: ' . $errObj->getMessage());

            case 'SOAPFault':
                exit ('Connection failed: ' . $errObj->detail);

            default:
                exit ('Down'); ;
        }
    }


    /**
     * Debug::formattedoutput()
     *
     * @param mixed $array
     * @param integer $indent_index
     * @return
     */
    public static function formattedoutput($array, $indent_index = 0){
        $output = '';

        if(!is_array($array)){
            return $array;
        }
        $color = 160 + ($indent_index % 5) * 18 ;
        $color2 = ($indent_index % 5) * 45;

        $output .= "<table style='width:95%;'>";

        foreach($array as $f_name => $f_value){
            $output .= "<tr>
				<td style='border:1px solid #ffffff; text-align:left; background-color:rgb(225,225," . $color . "); color:rgb( 50 ," . $color2 . ",50);'><b>";
            $output .= htmlspecialchars($f_name);
            $output .= "	</b></td>
				<td style='text-align:left'>";

            if(is_array($f_value)){
                $output .= self::formattedoutput($f_value, $indent_index + 1);
            }elseif(is_object($f_value)){
                $output .= "Object::" . get_class($f_value);
            }else{
                $output .= nl2br(chunk_split(str_replace(array('\n', chr(10), chr(13), '\r', '\r\n'), '', htmlspecialchars($f_value)), 200)); //nl2br(htmlspecialchars($f_value));

            }
            $output .= "</td>
			</tr>";
        }
        $output .= "</table>";

        return $output;
    }


    /**
     * Debug::getDebugInfo()
     *
     * @return an html table of debug info
     */
    public static function getInfo(){
        $output = '';
        // calculate how long the script has taken to execute

        $exec_time = microtime(true)-Page::getStartTime();

        // ob_start();
        $output .= "<div style =' padding-right:20px; padding-left:20px ' >";
        $output .= "<h1 style = 'text-align:center' > ------------DEBUG INFO------------ </h1>";
        $output .= '<hr />';
        $output .= "<h3 style='color:blue'>EXECUTION TIME</h3> " . round($exec_time, 5);
        $output .= '<hr />';

        if(!empty($action)){
            $output .= "<h3 style='color:blue'>ACTION VARIABLES</h3>";
            $output .= self::formattedoutput($action);
            $output .= '<hr />';
        }
        if(!empty($_FILES)){
            $output .= "<h3 style='color:blue'>UPLOAD FILE</h3>";
            $output .= self::formattedoutput($_FILES);
            $output .= '<hr />';
        }
        if(!empty($_POST)){
            $output .= "<h3 style='color:blue'>POST VARIABLES</h3>";
            $output .= self::formattedoutput ($_POST);
            $output .= '<hr />';
        }

        if(!empty($_GET)){
            $output .= "<h3 style='color:blue'>GET VARIABLES</h3>";
            $output .= self::formattedoutput ($_GET);
            $output .= '<hr />';
        }

        if(!empty($_SERVER)){
            $output .= "<h3 style='color:blue'>SERVER VARIABLES</h3>";
            $output .= self::formattedoutput ($_SERVER);
            $output .= '<hr />';
        }

        $output .= "<h3 style='color:blue'>COOKIE VARIABLES</h3>";
        $output .= self::formattedoutput($_COOKIE);
        $output .= '<hr />';

        $total_time = array_sum(TABLE::$trace);
        $output .= "<h3 style='color:blue'>DATABASE QUERIES</h3>";
        $output .= "<b>QUERIES: " . count(TABLE::$trace) . "<br />
                 TOTAL TIME: " . $total_time . " of " . $exec_time . " ------> " . (($total_time / $exec_time) * 100) . "% </b>";

        $output .= self::formattedoutput(TABLE::$trace);
        $output .= "<h3 style='color:blue'>SESSION VARIABLES </h3>";
        $output .= self::formattedoutput($_SESSION[APP]);
        $output .= "</div>";

        return $output;
    }
}

?>