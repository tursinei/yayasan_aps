<?php
/**
 * Created by PhpStorm.
 * User: VILLA
 * Date: 02/04/2019
 * Edited : Velly 28/01/2023
 * Time: 15:53
 */

namespace App;

class Helper
{
    public static function setResponse($message, $data = '', $code = 200)
    {
        $return = ['message' => $message];
        if($data != ''){
            $return['data'] = $data;
        }
        return response()->json($return, $code);
    }

    public static function getStringBetween($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini    = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return trim(substr($string, $ini, $len));
    }
}
