<?php

/**
 * 快递公司查询
 *
 * @author: moxiaobai
 * @since : 2016/5/13 11:33
 */

class Express_Company {

    /**
     * 获取快递编码
     *
     * @param $num
     * @return bool
     */
    public static function getCode($num) {
        $key = Express_Config::KEY;
        $url = "http://www.kuaidi100.com/autonumber/auto?num={$num}&key={$key}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($result, true);
        if($data) {
            return $data[0]['comCode'];
        } else {
            return false;
        }
    }
}