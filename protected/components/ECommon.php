<?php
/**
 * Enter description here ...
 * @author xiaopeng
 *
 */
class ECommon {
/**
 * Enter description here ...
 * @param unknown_type $data
 * @param unknown_type $key
 * @param unknown_type $val
 * @return multitype:NULL
 */
    public static function setDropListArray($data,$key,$val) {
        $new_arr = array();
        $new_arr[''] = '请选择';
        foreach($data as $k => $v) {
            $new_arr[$v->$key] = $v->$val;
        }
        return $new_arr;
    }

    public static function getFrontTime($time) {
        return date('m/d',strtotime($time));
    }
    
    public static function getYmdTime($time) {
        return date('Y-m-d',strtotime($time));
    }

    public static function truncate_utf8_string($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }
}