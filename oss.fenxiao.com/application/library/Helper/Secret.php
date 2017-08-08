<?php

/**
 * 加密解密字符串
 * 
 */

class Helper_Secret {
	
	const AUTH_KEY = '^@@!@$';
	
	/**
	 * 加密字符串
	 * 
	 * @param string $string 待加密的字符串
	 * @return string
	 */
	public static function encode($string){
		$skey = Helper_Secret::AUTH_KEY;
		
		$strArr = str_split(base64_encode($string));
		$strCount = count($strArr);
		foreach (str_split($skey) as $key => $value) {
			$key < $strCount && $strArr[$key].=$value;
			return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
		}	
	}

	/**
	 * 解密字符串
	 * 
	 * @param string $string 加密过的字符串
	 * @return string
	 */
	public static function decode($string) {
		$skey = Helper_Secret::AUTH_KEY;
		
		$strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
		$strCount = count($strArr);
		foreach (str_split($skey) as $key => $value) {
			$key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
			return base64_decode(join('', $strArr));
		}
	}
}