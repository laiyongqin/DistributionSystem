<?php

/**
 * 获取定位
 
 * @author: moxiaobai(mlkom@live.com)
 * @since : 2015-07-16 
 */

class Helper_Location {

    public static function getIpInfo() {
        $ip = self::getIp();

        $url = "http://ip.taobao.com//service/getIpInfo.php?ip={$ip}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        $output = curl_exec($ch) ;

        curl_close($ch);

        $data =  json_decode($output, true);
        if($data['code'] == 0) {
            return $data['data'];
        } else {
            return false;
        }

    }

    public static function getIp() {
        if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if (@$_SERVER["HTTP_CLIENT_IP"])
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if (@$_SERVER["REMOTE_ADDR"])
            $ip = $_SERVER["REMOTE_ADDR"];
        else if (@getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (@getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (@getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "Unknown";
        return $ip;
    }

    public static function getIpString() {
        $ip = self::getIp();
        return  bindec(decbin(ip2long($ip)));
    }

    public static function getIpByString($string) {
        return long2ip($string);
    }
}