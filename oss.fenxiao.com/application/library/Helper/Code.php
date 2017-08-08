<?php

/**
 * 随机码
 * 
 * @author moxiaobai
 * @since  2013-03-29
 */

class Helper_Code {

	static function getRandCode($len=6) {
		if($len <= 0) return false;

		$str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ";
        $code = '';
        for ($i = 0; $i < $len; $i++) {
            $code .= $str{rand(0, strlen($str) - 1)};
        }
        return $code;
	}
	
	static function getRandLetter($len=4) {
		if($len <= 0) return false;

		$str = "abcdefghijkmnpqrstuvwxyz";
        $code = '';
        for ($i = 0; $i < $len; $i++) {
            $code .= $str{rand(0, strlen($str) - 1)};
        }
        return $code;
	}

    static function getActiveCode($len=4) {
        if($len <= 0) return false;

        $str = "0123456789";
        $code = '';
        for ($i = 0; $i < $len; $i++) {
            $code .= $str{rand(0, strlen($str) - 1)};
        }
        return $code;
    }
}