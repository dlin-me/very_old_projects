<?php

/**
 * Control
 * This class encapsurate the generation of HTML blocks/controls
 *
 * @package
 * @author Administrator
 * @copyright Copyright (c) 2007
 * @version $Id$
 * @access public
 */
class Control{


    public static function htmlSelect(array $params){
        $mp['name'] = '';
        $mp['id']= '';
        $mp['class']= '';
        $mp['style']= '';
        $mp['script']= '';
        $mp['options']= '';
        $mp['value'] = '';
        $params = array_merge($mp, $params);

        $return = '<select name="' . $params['name'] . '" id="' . $params['id'] . '" class="'. $params['class'] .'" style="' . $params['style'] .'" ' . $params['script'] . '>\n';



        if(is_array($params['options'])){
            foreach($params['options'] as $code => $optionText){
                $selected = (isset($params['value']) && $code == $params['value'])?" selected=selected ":'';
                $return .= "<option value='" . $code . "' " . $selected . ">" . $optionText . "</option>\n";
            }
        }
        $return .= "</select>\n";
        return $return;
    }


    public static function htmlTextbox(array $params){
        $mp['name'] = '';
        $mp['id']= '';
        $mp['class']= '';
        $mp['style']= '';
        $mp['script']= '';
        $mp['options']= '';
        $mp['value']= '';
        $params = array_merge($mp, $params);

        $return = '<input type="text" value="' . $params['value'] . '" name="' . $params['name'] . '" id="' . $params['id'] . '" class="'. $params['class'] .'" style="' . $params['style'] .'" ' . $params['script'] . '>';

        return $return;

    }

	public static function htmlTextLabel(array $params){
        $mp['name'] = '';
        $mp['id']= '';
        $mp['class']= '';
        $mp['style']= '';
        $mp['script']= '';
        $mp['options']= '';
        $mp['value']= '';
        $params = array_merge($mp, $params);

        $return = '<span type="text"  name="' . $params['name'] . '" id="' . $params['id'] . '" class="'. $params['class'] .'" style="' . $params['style'] .'" ' . $params['script'] . '>'. $params['value'] . '</span>';

        return $return;
	}
	public static function htmlDateLabel(array $params){
        $mp['name'] = '';
        $mp['id']= '';
        $mp['class']= '';
        $mp['style']= '';
        $mp['script']= '';
        $mp['options']= '';
        $mp['value']= '';
        $params = array_merge($mp, $params);

        $return = '<span type="text"  name="' . $params['name'] . '" id="' . $params['id'] . '" class="'. $params['class'] .'" style="' . $params['style'] .'" ' . $params['script'] . '>'.Format::strDate($params['value']) . '</span>';

        return $return;
	}

	public static function htmlDateTimeLabel(array $params){
        $mp['name'] = '';
        $mp['id']= '';
        $mp['class']= '';
        $mp['style']= '';
        $mp['script']= '';
        $mp['options']= '';
        $mp['value']= '';
        $params = array_merge($mp, $params);

        $return = '<span type="text"  name="' . $params['name'] . '" id="' . $params['id'] . '" class="'. $params['class'] .'" style="' . $params['style'] .'" ' . $params['script'] . '>'.Format::strDateTime($params['value']) . '</span>';

        return $return;
	}
    /**
     * Control::ctrlMemberName()
     *
     * @return The nick name of the user stored as logged in member or from cookie
     */
    public static function ctrlMemberName(){
        if(Auth::isMember()){
            return RowSet::get('Member',Auth::getId())->mem_nick;
        }else{
            $cookieObj = new Cookie();
            if($cookieObj->name){
                return $cookieObj->name;
            }else{
                return null;
            }
        }
    }


    public static function ctrlCatSelector($params){
        $catTbl = Cat::getTbl();
        $tree = $catTbl->getTreeIds();


        $start_point = isset($params['start']) ? $params['start'] : 0;
        $data = $catTbl->getLevelIds($tree, $tree[$start_point]);



        $option = array();
        foreach($data as $dt){
            $option[$dt[0]] = str_pad("", intval($dt[1])*6*8, "&nbsp;", STR_PAD_LEFT);
            $option[$dt[0]] .= RowSet::get('Cat', intval($dt[0]))->cat_name;
        }

        $params['options'] = $option;

        return self::htmlSelect($params);

    }

    /**
     * Control::ctrlPaginator()
     *
     * @param mixed $info
     * @return a HTML paginator
     */
    public static function ctrlPaginator($info){
        if($info['itemTotal'] <= 0){
            return '';
        }

        $return ='<div class="Pagination">
        	Showing '.$info['itemStart'].'-'.$info['itemEnd'].' of '.$info['itemTotal'].' listings:';

        if($info['pageStart'] > 1){
            $return .= '<a href="'.WEB_DIR.'/action.php?p=1" class="squareBtn">&lt;&lt;</a>';
        }
        if($info['pagePointer'] > $info['pageStart']){
            $return .= '<a href="'.WEB_DIR.'/action.php?p=1" class="squareBtn">&lt;</a>';
        }
        for($i = $info['pageStart']; $i<=$info['pageEnd']; $i++){
            $return .= '<a href="'.WEB_DIR.'/action.php?p='.$i.'">'.$i.'</a>';
        }
        if($info['pagePointer'] < $info['pageEnd']){
            $return .= '<a href="'.WEB_DIR.'/action.php?p=2" class="squareBtn">&gt;</a>';
        }
        if($info['pageEnd'] < $info['pageTotal']){
            $return .= '<a href="'.WEB_DIR.'/action.php?p=4" class="squareBtn">&gt;&gt;</a>';
        }
        	$return .= 'Totally '.$info['pageTotal'].' Pages</div>';

        return $return;
    }

}

?>