<?php

class Str
{

    public static function slug($string, $split = '-')
    {
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $split, preg_replace('/[^A-Za-z0-9-]+/', $split, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $string))))), $split));
        return $slug;
    }

    public static function camel($string, $removeSpace = true)
    {
        if ($removeSpace) {
            return str_replace(" ", "", ucwords($string, " "));
        } else {
            return ucwords($string);
        }
    }
    public static function snake($string, $delimiter = " ")
    {
        return str_replace($delimiter, "_", $string);
    }
    public static function between($string, $between = [], $returnAll = false)
    {
        $data = explode(chr(1), str_replace($between, chr(1), $string));
        if ($returnAll) {
            return $data;
        } else {
            return $data[1];
        }
    }
    public static function upper($string)
    {
        return strtoupper($string);
    }
    public static function lower($string)
    {
        return strtolower($string);
    }
    public static function capitalize($string)
    {
        return ucfirst($string);
    }
    public static function truncate($string, $limit = 10, $continue = '...')
    {

        $data = strip_tags($string);
        return substr($string, 0, $limit) . $continue;
    }
    public static function tr($string, $arr = [])
    {
        return strtr($string, $arr);
    }
    public static function dot_array($string)
    {
        $ex = explode(".", $string);
        return $ex;
    }
    public static function dot_end($string)
    {
        $ex = explode(".", $string);
        return end($ex);
    }
    public static function contains($string, $contain)
    {
        if (preg_match("/{$contain}/g", $string)) {
            return true;
        } else {
            return false;
        }
    }
    public static function length($string)
    {
        return strlen($string);
    }
    public static function pad_left($string, $length, $pad = ' ')
    {
        return str_pad($string, $length, $pad, STR_PAD_LEFT);
    }
    public static function pad_right($string, $length, $pad = '')
    {
        return str_pad($string, $length, $pad, STR_PAD_RIGHT);
    }
    public static function nl2br($text)
    {
        return str_replace("\n", "<br>", $text);
    }
    public static function br2nl($text)
    {
        return str_replace("<br>", "\n", $text);
    }
}
