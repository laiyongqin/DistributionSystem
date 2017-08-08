<?php

/**
 * Curl方式上传到图片服务器
 *
 * @author: moxiaobai(mlkom@live.com)
 * @since : 2015-08-02 
 */

class Images_Curl {

    public static function uploadLocalFile($filepath, $params) {
        $uploadUrl = 'http://upload.lvv.net/';

        if (empty($filepath)) {
            throw new Exception('$filepath is required');
        }

        if (empty($params) || !is_array($params)) {
            throw new Exception('$params is required');
        }

        if (class_exists("CURLFile")) {
            $params['file'] = new CURLFile($filepath);
        } else {
            $params['file'] = '@' . $filepath;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_URL, $uploadUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $output = curl_exec($ch);

        if($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            $result = array('code'=>$errno, 'msg'=>$error_message);
            return json_encode($result);
        }
        curl_close($ch);
        return $output;
    }
}