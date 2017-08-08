<?php
/**
 * Helper_Cookie  
 *
 * @category Helper
 * @package  Helper_Cookie
 * @version  1.0 
 */
class Helper_Cookie{

 	/**
	 * setUniqueCookie        设置唯一Key的Cookie，返回写入Cookie是否成功
	 * 
	 * @param  $cookie_key    cookie键名
	 * @param  $id            可以是未加密的id会自动加密
	 * @return boolean        写入Cookie是否成功，如果Cookie已存在返回FLASE
	 */
	public function setUnique( $cookie_key, $id ) {
		//判断是否用户已经有过类似操作，写入Cookie
        $encrypt_id = is_numeric($id) ? Arithmetic_Id::encrypt($id) : $id;
        $expire     = time() + 86400*30;
        if ( isset($_COOKIE[ $cookie_key ]) ) {
            $cookie = Helper_Filter::format( $_COOKIE[ $cookie_key ], true);
            if ( strpos($cookie, $encrypt_id) === FALSE ) {
                setcookie($cookie_key, $cookie . '.' . $encrypt_id, $expire );
            } else {
                return FALSE;
            }
        } else {
            setcookie($cookie_key, $encrypt_id, $expire );
        }
        return TRUE;
	}



    /**
     * setUniqueCookieByFlag  通过Flag 设置唯一Key的Cookie，返回写入Cookie是否成功
     * 
     * @param  $cookie_key    cookie键名
     * @param  $id            可以是未加密的id会自动加密
     * @param  $flag          标识Flag，如果c_id，标识某个用户
     * @return boolean        写入Cookie是否成功，如果Cookie已存在返回FLASE
     */
    public function setUniqueByFlag( $cookie_key, $id, $flag ) {
        //判断是否用户已经有过类似操作，写入Cookie
        $encrypt_id   = is_numeric($id) ? Arithmetic_Id::encrypt($id) : $id;
        $encrypt_flag = is_numeric($flag) ? Arithmetic_Id::encrypt($flag) : $flag;
        $expire       = time() + 86400*30;

        if ( isset($_COOKIE[ $cookie_key ]) ) {
            $cookie = Helper_Filter::format( $_COOKIE[ $cookie_key ], true);
            if ( strpos( $cookie, "{$encrypt_flag}-" ) === 0 ) {
                //Flag Cookie有存在！
                if ( strpos($cookie, $encrypt_id) === FALSE ) {
                    setcookie( $cookie_key, $cookie . '.' . $encrypt_id, $expire, '/' );
                } else {
                    return FALSE;
                } 
            } else {
                setcookie($cookie_key, "{$encrypt_flag}-{$encrypt_id}", $expire, '/' );
            }
        } else {
            setcookie($cookie_key, "{$encrypt_flag}-{$encrypt_id}", $expire, '/' );
        }
        return TRUE;
    }


    public function hasUniqueByFlag( $cookie_key, $id, $flag ) {
        $encrypt_id   = is_numeric($id) ? Arithmetic_Id::encrypt($id) : $id;
        $encrypt_flag = is_numeric($flag) ? Arithmetic_Id::encrypt($flag) : $flag;
        $expire       = time() + 86400*30;

        if ( isset($_COOKIE[ $cookie_key ]) ) {
            $cookie = Helper_Filter::format( $_COOKIE[ $cookie_key ], true);
            if ( strpos( $cookie, "{$encrypt_flag}-" ) === 0 ) {
                //Flag Cookie有存在！
                if ( strpos($cookie, $encrypt_id) !== FALSE ) {
                    return TRUE;
                } 
            }
        }
        return FALSE;
    }
}