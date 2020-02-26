<?php

namespace Ares\Utility;

class Encoder
{
    /**
     * @param string|array|object $array
     */
    public static function utf8_encode_recursive(&$array)
    {
        if (is_string($array)) {
            $array = utf8_encode($array);
        } elseif (is_array($array)) {
            foreach ($array as &$value) {
                utf8_encode_deep($value);
            }
            unset($value);
        } elseif (is_object($array)) {
            $vars = array_keys(get_object_vars($array));
            foreach ($vars as $var) {
                utf8_encode_deep($array->$var);
            }
        }
    }

}
